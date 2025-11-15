<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Backend\UserRepositoryInterface;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function profile(Request $request)
    {
        $user = Auth::user();

        if ($request->isMethod('get')) {
            return view('dashboard.user.profile', ['user' => $user]);
        }

        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'profile' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        try {
            $this->userRepository->updateProfileWithImage($user->id, $validated, $request->file('profile'));

            return redirect()->route('dashboard.profile')
                ->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'An error occurred while updating your profile. Please try again.',
            ])->withInput();
        }
    }
}
