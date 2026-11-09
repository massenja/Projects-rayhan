<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('admin.home');
        }else {
            return view('login');
        }
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials))  {
            $request->session()->regenerate();
            return redirect()->route('admin.home');
        }else {
            $request->session()->flash('error', 'email atau password salah wok');
            return redirect('/login');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
