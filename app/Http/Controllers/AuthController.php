<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // get
    public function login()
    {
        return view('Auth.login');
    }

    public function register()
    {
        return view('Auth.register');
    }

    // post
    public function loginProcess(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $login = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if ($login) {
            return redirect('/');
        }
        return redirect('/login')->with('error', 'Email or password wrong');
    }

    public function registerProcess(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'confPassword' => 'required|same:password',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $register = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $register->save();

        if ($register) {
            return redirect('/login')->with('success', 'register success');
        }
        return redirect('/welcome')->with('error', 'register failed');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logout success');
    }
}
