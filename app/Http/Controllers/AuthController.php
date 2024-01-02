<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;

class AuthController extends Controller
{
    public function showFormLogin()
    {
        if (Auth::check()) {
            // Login Success
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $rules = [
            'email'    => 'required|email',
            'password' => 'required|string',
        ];

        $messages = [
            'email.required'    => 'Email wajib diisi',
            'email.email'       => 'Email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.string'   => 'Password harus berupa string',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $credentials = [
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            // Login Success
            return redirect()->route('dashboard');
        } else {
            // Login Fail
            Session::flash('error', 'Email atau password salah');
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        Auth()->logout();
        return redirect()->route('login');
    }
}
