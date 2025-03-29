<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function showSignupForm()
    {
        return view('auth.signup');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|alpha|string|max:255',
            'last_name' => 'required|alpha|string|max:255',
            'email' => 'required|email|unique:my_users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user)); // Triggers email verification

        return redirect()->route('my_login')->with('success', 'Registration successful! Please login.');
    }

     public function showLoginForm()
    {
        return view('auth.login');
    }

   // Handle Login Request
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            /*if (!Auth::user()->hasVerifiedEmail()) {
                Auth::logout();
                return back()->with('error', 'You need to verify your email before logging in.');
            }*/
            return redirect()->route('booking');
        }

        return back()->withErrors(['email' => 'Invalid email or password'])->withInput();
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('my_login')->with('success', 'Logged out successfully');
    }
}

?>