<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function signup() {
        return view("auth.signup");
    }

    public function login() {
        return view("auth.login");
    }

    public function account() {
        return view("profile.account");
    }

    public function cart() {
        return view("profile.cart");
    }

    public function register_validation(Request $request) {
        $request->validate([
            'name' => 'required|string|min:2',
            'surname' => 'required|string|min:2',
            'email' => 'required|email|unique:users, email',
            'password' => 'required|min:4|confirmed'
        ]);

        return $request->only('name', 'surname', 'email', 'password');
    }

    public function login_validation(Request $request) {
        $request->validate([
            'email'=> 'required|email',
            'password'=> 'required|min:4'
        ]);

        return $request->only('email','password');
    }

    public function register(Request $request) {
        $this->register_validation($request);

        User::create([
            'name'=> $request->input('name'),
            'surname' => $request->input('surname'),
            'email'=> $request->input('email'),
            'password'=> Hash::make($request->input('password')),
        ]);

        Auth::attempt($request->only('email','password'), $request->filled('remember'));
        return redirect()->intended(route('home'));
    }

    public function connection(Request $request) {
        $this->login_validation($request);

        $credentials = $request->only('email','password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        } else {
            return redirect()->route('login')->withErrors([
                'invalid' => 'Invalid email or password'
            ])->withInput();
        }
    }

    public function logoutAccount() {
        Auth::logout();
        return redirect()->route('home');
    }

    public function updateAccount(Request $request) {
        $request->validate([
            'email' => 'nullable|email|unique:users,email,' . Auth::id(), 
            'inputNewPassword' => 'nullable|min:4|confirmed'
        ]);
    
        $user = Auth::user();
    
        if ($request->filled('email')) {
            $user->email = $request->input('email');
        }

        if ($request->filled('inputNewPassword')) {
            if (!Hash::check($request->input('inputOldPassword'), $user->password)) {
                return redirect()->route('account.settings')->withErrors(['error' => 'L\'ancien mot de passe est incorrect.']);
            }

            $user->password = Hash::make($request->input('inputNewPassword'));
        }
    
        $user->save();
        Auth::logout();
        return redirect()->route('account.settings');
    }

    public function deleteAccount() {
        Auth::user()->delete();
        return $this->logoutAccount();
    }
}
