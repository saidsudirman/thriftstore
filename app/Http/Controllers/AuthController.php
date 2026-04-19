<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required',
            'email' => 'required|email|unique:users'
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
        ]);

        return redirect('/login')->with('success', 'Register berhasil!');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            // update status login
            $user->update([
                'status_login' => true
            ]);

            session([
                'user_id' => $user->id,
                'username' => $user->username
            ]);

            return redirect('/')->with('success', 'Login berhasil');
        }

        return back()->with('error', 'Username atau password salah');
    }

    public function logout()
    {
        $user = User::find(session('user_id'));

        if ($user) {
            $user->update([
                'status_login' => false
            ]);
        }

        session()->flush();

        return redirect('/login');
    }
}