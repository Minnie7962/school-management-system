<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Custom Login Method
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Log login attempt
            $this->logLoginAttempt($user);

            // Redirect based on role
            return $this->redirectBasedOnRole($user);
        }

        return back()
            ->withErrors(['email' => 'Invalid credentials'])
            ->withInput($request->only('email'));
    }

    // Custom Registration Method
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:student,teacher,admin,owner'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'user_id' => $this->generateUniqueUserId($request->role)
        ]);

        // Additional profile creation based on role
        $this->createUserProfile($user, $request);

        Auth::login($user);

        return $this->redirectBasedOnRole($user);
    }

    // Generate Unique User ID
    protected function generateUniqueUserId($role)
    {
        $prefix = substr($role, 0, 1);
        $timestamp = now()->format('ymd');
        $randomDigits = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        
        return strtoupper($prefix . $timestamp . $randomDigits);
    }

    // Create User Profile
    protected function createUserProfile($user, $request)
    {
        switch ($user->role) {
            case 'student':
                Student::create([
                    'email' => $user->email,
                    'student_id' => $this->generateUniqueUserId('student'),
                    // Add other required fields
                ]);
                break;
            case 'teacher':
                Teacher::create([
                    'email' => $user->email,
                    'teacher_id' => $this->generateUniqueUserId('teacher'),
                    // Add other required fields
                ]);
                break;
            // Similar cases for admin and owner
        }
    }

    // Redirect Based on Role
    protected function redirectBasedOnRole($user)
    {
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'student':
                return redirect()->route('student.dashboard');
            case 'teacher':
                return redirect()->route('teacher.dashboard');
            case 'owner':
                return redirect()->route('owner.dashboard');
            default:
                Auth::logout();
                return redirect()->route('login')->withErrors(['error' => 'Unauthorized role.']);
        }
    }

    // Log Login Attempt
    protected function logLoginAttempt($user)
    {
        // Implement login logging logic
        LoginLog::create([
            'user_id' => $user->id,
            'ip_address' => request()->ip(),
            'login_at' => now()
        ]);
    }

    // Logout Method
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
