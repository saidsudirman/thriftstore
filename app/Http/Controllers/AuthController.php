<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function dashboard()
    {
        if (!session('user_id')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        return view('dashboard');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $token = Str::random(64);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 0,
            'status_login' => false,
            'verify_token' => $token,
        ]);

        $verificationUrl = url('/verify/' . $token);

        Mail::send([], [], function ($message) use ($user, $verificationUrl) {
            $message->to($user->email)
                ->subject('Confirm Registration')
                ->html("
            <h2>Thrift Toko YBD</h2>
            <p>Halo,</p>
            <p>Terima kasih sudah mendaftar.</p>
            <p>Silakan klik tombol di bawah untuk mengaktifkan akun kamu:</p>

            <a href='$verificationUrl' 
               style='display:inline-block;
                      padding:12px 20px;
                      background-color:#4CAF50;
                      color:white;
                      text-decoration:none;
                      border-radius:5px;
                      font-weight:bold;'>
               Confirm Registration
            </a>

            <p style='margin-top:20px;'>Jika kamu tidak mendaftar, abaikan email ini.</p>
        ");
        });

        return redirect('/login')->with('success', 'Register berhasil! Silakan cek email untuk verifikasi.');
    }

    public function verify($token)
    {
        $user = User::where('verify_token', $token)->firstOrFail();

        if ($user->email_verified_at) {
            return redirect('/login')->with('success', 'Email sudah diverifikasi sebelumnya.');
        }

        $user->update([
            'email_verified_at' => now(),
            'status' => 1,
            'verify_token' => null,
        ]);

        return redirect('/login')->with('success', 'Email berhasil diverifikasi! Silakan login.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->login)
            ->orWhere('email', $request->login)
            ->first();

        if (!$user) {
            return back()->withInput()->with('error', 'User atau password salah');
        }

        if (!$user->email_verified_at) {
            return back()->withInput()->with('error', 'Email belum diverifikasi');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withInput()->with('error', 'User atau password salah');
        }

        $user->update([
            'status_login' => true
        ]);

        session([
            'user_id' => $user->id,
            'username' => $user->username,
        ]);

        return redirect()->route('dashboard')->with('success', 'Login berhasil');
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

        return redirect('/login')->with('success', 'Logout berhasil');
    }
}