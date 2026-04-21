<?php

namespace App\Http\Controllers;

use App\Mail\VerifyUserMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Throwable;

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
        ], [
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah dipakai',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah dipakai',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 0,
            'status_login' => false,
        ]);

        $verificationUrl = route('verify', $user->id);

        try {
            Mail::to($user->email)->send(new VerifyUserMail($user, $verificationUrl));

            return redirect()->route('login')->with('success', 'Register berhasil! Silakan verifikasi email Anda.');
        } catch (Throwable $e) {
            return redirect()->route('login')->with([
                'error' => 'Akun berhasil dibuat, tetapi email verifikasi gagal dikirim. Gunakan link verifikasi manual di bawah ini.',
                'verify_link' => $verificationUrl,
            ]);
        }
    }

    public function verify($id)
    {
        $user = User::findOrFail($id);

        if ((int) $user->status === 1) {
            return redirect()->route('login')->with('success', 'Akun sudah diverifikasi sebelumnya.');
        }

        $user->update([
            'status' => 1,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Verifikasi berhasil! Anda bisa login sekarang.');
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
        ], [
            'login.required' => 'Username atau email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $user = User::where('username', $request->login)
            ->orWhere('email', $request->login)
            ->first();

        if (!$user) {
            return back()->withInput($request->only('login'))->with('error', 'Maaf user/pass anda salah');
        }

        if ((int) $user->status === 0) {
            return back()->withInput($request->only('login'))->with('error', 'Maaf anda belum melakukan verifikasi');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withInput($request->only('login'))->with('error', 'Maaf user/pass anda salah');
        }

        $user->update([
            'status_login' => true
        ]);

        session([
            'user_id' => $user->id,
            'username' => $user->username,
        ]);

        return redirect()->route('dashboard')->with('success', 'Anda berhasil login');
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

        return redirect()->route('login')->with('success', 'Anda berhasil logout');
    }
}