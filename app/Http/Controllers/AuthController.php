<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    //Register with google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {

            $user = new User();

            $user->name = $googleUser->getName();
            $user->email = $googleUser->getEmail();
            $user->password = str()->random(32);

            $user->save();
        }

        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->route('home');
    }

    //Register
    public function registerView()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        // dd($user);
        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('home');
    }

    //login
    public function create()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->only('email', 'password');

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->with('error', 'wrong email or password');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login-view');
    }
}
