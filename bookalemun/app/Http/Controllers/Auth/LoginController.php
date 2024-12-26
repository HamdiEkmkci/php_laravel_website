<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    public function loginView()
    {
        return view('front.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->has('remember'))) {

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Email veya şifre yanlış.',
        ])->withInput($request->only('email', 'remember'));
    }


    public function signIn()
    {
        return view('front.signIn');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'user_name' => 'required|string|max:20|unique:users',
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = new User([
            'user_name' => $validatedData['user_name'], // Düzeltilmiş alan adı
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $user->save();

        return redirect()->route('loginView')->with('success', 'Kayıt başarılı! Giriş yapabilirsiniz.');
    }


    public function forgotPassword()
    {
        return view('front.forgotpassword');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
