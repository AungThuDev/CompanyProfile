<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contracts\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    { 
        $users = $this->userRepository->paginate();
        return view('dashboard.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = $this->userRepository->findById($id);
        return view('dashboard.users.show', compact('user'));
    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users,email'],
            'password' => ['required','string','min:6'],
        ]);

        try { 
            $this->userRepository->create($validated);
            return redirect()->route('dashboard.users.index')
                             ->with('success', 'User created successfully!');
        }catch(Exception $e) { 
            return back()
            ->withErrors(['error' => 'Failed to create user. Please try again.'])
            ->withInput();
        }
    }

    public function suspend(int $id)
    {
        try {
            $this->userRepository->suspend($id);

            return redirect()->route('dashboard.users.index')
                            ->with('success', 'User suspension status updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.users.index')
                            ->withErrors(['error' => 'Failed to update user suspension.']);
        }
    }


    public function profile(Request $request)
    {
        $user = Auth::user();

        if ($request->isMethod('get')) {
            return view('dashboard.users.profile', ['user' => $user]);
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

    public function settings()
    { 
        return view('dashboard.users.settings');
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed', 
        ]);

        DB::beginTransaction();

        try { 
            $user = Auth::user();
    
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
    
            $user->password = Hash::make($request->password);
            $user->save();
    
            return back()->with('success', 'Password changed successfully.');
        }catch(Exception $e) { 
            return back()->withErrors([
                'error' => 'An error occurred while changing your password. Please try again.',
            ])->withInput();
        }
    }
}
