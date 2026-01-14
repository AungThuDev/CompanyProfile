<?php 

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPassword;
use App\Mail\TwoFactorCodeMail;
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
        if ($request->isMethod('get')) {
            if (Auth::check()) {
                return redirect()->route('dashboard.index');
            }
            return view('auth.login');
        }if (Auth::check()) {
            return redirect()->route('dashboard.index');
        }
        

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        $user = Auth::user();

        /**
         * 1️⃣ Suspended check
         */
        if ($user->suspended_at) {
            Auth::logout();

            return back()->withErrors([
                'email' => 'Your account has been suspended.',
            ])->onlyInput('email');
        }

        /**
         * 2️⃣ Email verification check
         */
        if (!$user->email_verified_at) {
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

                Mail::to($credentials['email'])->send(
                    new VerifyEmail($code, $credentials['email'])
                );

                return back()->with('status', 'We have emailed your email verification link!');
            } catch (\Exception $e) {
                DB::rollBack();

                return back()->withErrors([
                    'email' => 'An error occurred while processing your request.',
                ])->onlyInput('email');
            }
        }

        /**
         * 3️⃣ TWO-FACTOR AUTHENTICATION CHECK (NEW)
         */
        if ($user->two_factor_enabled) {

            // Logout temporarily
            Auth::logout();

            $code = $this->generateCode();

            DB::beginTransaction();

            try {
                // Clean previous codes
                $user->twoFactorCodes()->delete();

                // Store new 2FA code
                $user->twoFactorCodes()->create([
                    'code' => $code,
                    'expires_at' => now()->addMinutes(10),
                ]);

                DB::commit();

                // Send 2FA code
                Mail::to($user->email)->send(
                    new TwoFactorCodeMail($code, $user->email)
                );

                // Store user id temporarily in session
                session([
                    '2fa:user:id' => $user->id,
                ]);

                return redirect()->route('auth.2fa.verify');
            } catch (\Exception $e) {
                DB::rollBack();

                return back()->withErrors([
                    'email' => 'Failed to send two-factor authentication code.',
                ])->onlyInput('email');
            }
        }

        /**
         * 4️⃣ Normal login success
         */
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard.index'));
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

    /**
     * Verify Two-Factor Authentication Code
     */
    public function verifyTwoFactor(Request $request)
    {
        $userId = session('2fa:user:id');

        if (!$userId) {
            return redirect()->route('auth.login')->withErrors([
                'email' => 'Your session has expired. Please login again.'
            ]);
        }

        $user = User::find($userId);

        if ($request->isMethod('get')) {
            return view('auth.two-factor-verify');
        }

        $request->validate([
            'code' => ['required', 'digits:6'],
        ]);

        $twoFactor = $user->twoFactorCodes()
            ->where('code', $request->code)
            ->where('expires_at', '>', now())
            ->first();

        if (!$twoFactor) {
            return back()->withErrors([
                'code' => 'Invalid or expired code.'
            ]);
        }

        // Delete used code
        $user->twoFactorCodes()->delete();

        // Login the user
        Auth::login($user);

        // Remove 2FA session
        $request->session()->forget('2fa:user:id');

        // Regenerate session
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard.index'));
    }


    public function generateCode(int $length = 6) 
    { 
        $max = (int) str_repeat('9', $length);
        return str_pad((string) random_int(0, $max), $length, '0', STR_PAD_LEFT);
    }
}