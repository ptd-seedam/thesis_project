<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\FormRequest\AuthRequest;
use Illuminate\Support\Facades\Auth;
use App\FormRequest\User\RegisterRequest;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(AuthRequest $request)
    {
        $credentials['email'] = $request->email;
        $credentials['password'] = $request->password;
        // Check if the user is already logged in
        if (Auth::attempt($credentials)) {
            if (Auth::user()->U_ROLE === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->U_ROLE === 'librarian') {
                return redirect()->route('librarian.dashboard');
            } elseif (Auth::user()->U_ROLE === 'student') {
                Auth::logout();
                return redirect()->route('login.show')->with('error', 'Bạn không có quyền truy cập vào trang này.');
            }
        }
        return back()->withErrors([
            'email' => 'Sai tài khoản hoặc mật khẩu.',
        ]);
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'You have been logged out successfully.');
    }
    public function showRegisterForm(){
        return view('auth.register');
    }
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'U_NAME' => $request->name,
            'U_PHONE' => $request->phone,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'U_ADDRESS' => $request->address,
            'U_ROLE' => 'student', // Default role for new users
            'U_TOKEN' => bin2hex(random_bytes(16)), // Generate a random token
        ]);

        Auth::login($user);

        return redirect('/login')->with('success', 'Registration successful!');
    }
}
