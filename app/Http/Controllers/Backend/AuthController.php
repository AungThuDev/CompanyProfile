<?php 

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPassword;
use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{ 
    /**
     * Show login form or handle login
     */
    public function login(Request $request)
    { 
        if($request->isMethod('get')) { 
            // Redirect to dashboard if already authenticated
            if (Auth::check()) {
                return redirect()->route('dashboard.index');
            }
            return view('auth.login');
        }

        // Validate login request
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to authenticate
        if (Auth::attempt($credentials)) {
            if(Auth::user()->suspended_at) { 
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Your account has been suspended.',
                ])->onlyInput('email');
            }

            if(!Auth::user()->email_verified_at) { 
                Auth::logout();

                $code = $this->generateCode();

                try {
                    DB::beginTransaction();

                    DB::table('email_verify_codes')->insert([
                        'email' => $credentials['email'], 
                        'code' => $code, 
                        'expires_at' => now()->addMinutes(20),
                    ]);

                    DB::commit();

                    // Send email after transaction commits
                    Mail::to($credentials['email'])->send(new VerifyEmail($code, $credentials['email']));

                    return back()->with('status', 'We have emailed your email verification link!');
                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::error('Failed to create email verification code: ' . $e->getMessage());

                    return back()->withErrors([
                        'email' => 'An error occurred while processing your request. Please try again.',
                    ])->onlyInput('email');
                }
            }

            $request->session()->regenerate();
            return redirect()->intended(route('dashboard.index'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Log the user out
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }

    public function forgotPassword(Request $request)
    { 
        if($request->isMethod('get')) { 
            return view('auth.forgot-password');
        }

        $validated = $request->validate([
            'email' => ['required', 'email', "exists:users,email"],
        ]);

        $email = $validated['email'];
        $token = Str::random(64);
        
        try {
            DB::beginTransaction();

            DB::table('password_reset_tokens')->where('email', $email)->delete();

            DB::table('password_reset_tokens')->insert([
                'email' => $email, 
                'token' => $token,
                'created_at' => now(),
            ]);

            DB::commit();

            // Send email after transaction commits
            Mail::to($email)->send(new ForgotPassword($token, $email));

            return back()->with('status', 'We have emailed your password reset link!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create password reset token: ' . $e->getMessage());

            return back()->withErrors([
                'email' => 'An error occurred while processing your request. Please try again.',
            ])->onlyInput('email');
        }
    }

    public function resetPassword(Request $request)
    { 
        if($request->isMethod('get')) { 
            return view('auth.reset-password', [ 
                'token' => $request->query('token'),
                'email' => $request->query('email'),
            ]);
        }

        $validated = $request->validate([ 
            'email' => ['required', 'email', "exists:users,email"], 
            'token' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
            'password_confirmation' => ['required'],
        ]);

        $token = DB::table('password_reset_tokens')
            ->where('email', $validated['email'])
            ->where('token', $validated['token'])
            ->first();

        if (!$token) {
            return back()->withErrors([
                'token' => 'This password reset link is invalid or expired.',
            ]);
        }
        
        try {
            DB::beginTransaction();

            User::where('email', $validated['email'])
                ->update(['password' => Hash::make($validated['password'])]);

            DB::table('password_reset_tokens')->where('email', $validated['email'])->delete();

            DB::commit();

            return redirect()->route('auth.login')->with('status', 'Your password has been reset successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to reset password: ' . $e->getMessage());

            return back()->withErrors([
                'password' => 'An error occurred while resetting your password. Please try again.',
            ]);
        }
    }

    public function verifyEmail(Request $request)
    { 
        if($request->isMethod('get')) { 
            return view('auth.verify-email', [ 
                'email' => $request->query('email'),
            ]);
        }

        $validated = $request->validate([
            'email' => ['required', 'email', "exists:users,email"], 
            'code' => ['required'],
        ]);

        $code = DB::table('email_verify_codes')
        ->where('email', $validated['email'])
        ->where('code', $validated['code'])
        ->first();

        if(!$code) { 
            return back()->withErrors([
                'code' => 'Email or code invalid!',
            ]);
        }

        if ($code->expires_at <= now()) {
            DB::table('email_verify_codes')->where('email', $validated['email'])->delete();
            return back()->withErrors([
                'code' => 'Expired verification code.'
            ]);
        }

        try {
            DB::beginTransaction();

            User::where('email', $validated['email'])
                ->update(['email_verified_at' => now()]);

            DB::table('email_verify_codes')->where('email', $validated['email'])->delete();

            DB::commit();

            return redirect()->route('auth.login')->with('status', 'Your email has been verified successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to verify email: ' . $e->getMessage());

            return back()->withErrors([
                'code' => 'An error occurred while verifying your email. Please try again.',
            ]);
        }
    }

    public function resendEmail(Request $request)
    { 
        $validated = $request->validate([ 
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $code = $this->generateCode();

        try {
            DB::beginTransaction();

            DB::table('email_verify_codes')->updateOrInsert(
                ['email' => $validated['email']],
                [ 
                    'code' => $code,
                    'expires_at' => now()->addMinutes(20)
                ] 
            );

            DB::commit();

            // Send email after transaction commits
            Mail::to($validated['email'])->send(new VerifyEmail($code, $validated['email']));

            return back()->with('status', 'A new verification code has been sent to your email.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to resend email verification code: ' . $e->getMessage());

            return back()->withErrors([
                'email' => 'An error occurred while sending the verification code. Please try again.',
            ])->onlyInput('email');
        }
    }

    public function generateCode(int $length = 6) 
    { 
        $max = (int) str_repeat('9', $length);
        return str_pad((string) random_int(0, $max), $length, '0', STR_PAD_LEFT);
    }
}