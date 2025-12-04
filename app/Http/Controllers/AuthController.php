<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function regisPage()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:13|unique:users,phone',
        ],
            [
                'phone.unique' => 'Nomor ini sudah digunakan',
            ]
        );
        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);
        Auth::login($user);

        return redirect()->route('login.page');
    }

    public function loginPage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credential = $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);
        if (Auth::attempt($credential)) {
            $request->session()->regenerate();
            if (Auth::user()->role === 'admin') {
                return redirect('/admin/dashboard');
            } elseif (Auth::user()->role === 'customer') {
                return redirect('/customer/dashboard');
            }

            return back()->withErrors([
                'phone' => 'Telepon belum terdaftar',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if (! Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors([
                'current_password' => 'password lama salah',
            ]);
        }

        return back()->with('success', 'Berhasil ganti password');
    }

    public function profile()
    {
        return view('auth.profile');
    }
}
