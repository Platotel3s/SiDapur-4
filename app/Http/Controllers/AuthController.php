<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private function normalizePhone(string $phone): string
    {
        return '62' . ltrim($phone, '0');
    }
    public function regisPage()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'password' => 'required|string|min:8|confirmed',
            'phone'    => 'required|digits_between:9,13|unique:users,phone',
        ]);

        $phone = $this->normalizePhone($request->phone);

        $user = User::create([
            'name'     => $request->name,
            'password' => Hash::make($request->password),
            'phone'    => $phone,
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
        $request->validate([
            'phone'    => 'required',
            'password' => 'required',
        ]);

        $phone = $this->normalizePhone($request->phone);

        if (Auth::attempt([
            'phone'    => $phone,
            'password' => $request->password,
        ])) {
            $request->session()->regenerate();

            return Auth::user()->role === 'admin'
                ? redirect('/admin/dashboard')
                : redirect('/customer/dashboard');
        }

        return back()->withErrors([
            'phone' => 'Nomor atau password salah',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function forgotPage() {
        return view('auth.forgot');
    }

    public function checkPhone(Request $request) {
        $request->validate([
            'phone'=>'required|string',
        ]);
        $phone='62'.ltrim($request->phone,'0');
        $user=User::where('phone',$phone)->first();
        if (!$user) {
            return back()->withErrors([
                'phone'=>'Nomor Tidak ada',
            ]);
        }
        session([
            'reset_phone'=>$phone,
        ]);
        return redirect()->route('reset.page');
    }

    public function resetPage() {
        if (!session('reset_phone')) {
            return redirect()->route('forgot.page');
        }
        return view('auth.reset');
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'password'=>'required|string|min:8|confirmed',
        ]);
        $phone=session('reset_phone');
        $user=User::where('phone',$phone)->first();
        if (!$user) {
            return redirect()->route('forgot.page');
        }
        $user->update([
            'password'=>Hash::make($request->password),
        ]);
        session()->forget('reset_phone');
        return redirect()->route('login.page')->with('success','Berhasil update password');
    }
}
