<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FakeAuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.fake-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        Session::put('fake_user', [
            'email' => $request->email,
            'role' => 'admin', 
        ]);

        return redirect('/admin/dashboard');
    }

    public function logout()
    {
        Session::forget('fake_user');

        return redirect('/login');
    }
}