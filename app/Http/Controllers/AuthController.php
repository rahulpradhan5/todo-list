<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    // >>>>>>>>>>>>>>>>>>login------------------------------------
    public function index()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        // dd($request);
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // login user here
        if (\Auth::attempt($request->only('email', 'password'))) {
            return redirect('/');
        }

        return redirect('login')->withError('Login deatils not valid');
    }

    // >>>>>>>>>>>>>>>>>>register------------------------------------

    public function register_view()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed',
        ]);

        // save user info
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password)
        ]);

        // login user here
        if (\Auth::attempt($request->only('email', 'password'))) {
            return redirect('/');
        }

        return redirect('register')->withError('Error');
    }

    // >>>>>>>>>>>>logout---------------
    public function logout()
    {
        \Session::flush();
        \Auth::logout();
        return redirect('login');
    }
}
