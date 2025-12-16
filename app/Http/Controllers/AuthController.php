<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function regisPage()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'password' => 'required|string|min:8|confirmed',
            'phone'    => 'required|string|max:13|unique:users,phone',
        ], [
                'phone.unique' => 'Nomor ini sudah digunakan',
            ]);

        $user = User::create([
            'name'     => $request->name,
            'password' => Hash::make($request->password),
            'phone'    => $request->phone,
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
            'phone'    => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credential)) {
            $request->session()->regenerate();

            return Auth::user()->role === 'admin'
                ? redirect('/admin/dashboard')
                : redirect('/customer/dashboard');
        }

        return back()->withErrors(['phone' => 'Login gagal']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function forgotPasswordPage()
    {
        return view('auth.forgot');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|exists:users,phone',
        ], [
                'phone.exists' => 'Nomor Handphone tidak terdaftar',
            ]);
        $user = User::where('phone', $request->phone)->first();
        $otp = rand(100000, 999999);
        $user->update([
            'reset_token'      => $otp,
            'reset_expires_at' => now()->addMinutes(5),
        ]);
        $this->sendOtpWhatsapp($user->phone, $otp);

        return redirect()->route('reset.page')->with([
            'phone'   => $request->phone,
            'success' => 'Kode OTP telah dikirim via WhatsApp',
        ]);
    }

    public function resetPasswordPage()
    {
        return view('auth.reset', [
            'phone' => session('phone'),
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'phone'    => 'required|string|exists:users,phone',
            'token'    => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('phone', $request->phone)
            ->where('reset_token', $request->token)
            ->first();

        if (! $user) {
            return back()->withErrors(['token' => 'Kode OTP salah']);
        }

        if (now()->greaterThan($user->reset_expires_at)) {
            return back()->withErrors(['token' => 'Kode OTP sudah kedaluwarsa']);
        }

        $user->update([
            'password'          => Hash::make($request->password),
            'reset_token'       => null,
            'reset_expires_at'  => null,
        ]);

        return redirect()->route('login.page')
            ->with('success', 'Password berhasil direset');
    }
    private function sendOtpWhatsapp($phone, $otp)
    {
        $message = "🔐 *Reset Password SiDapur*\n\n"
            . "Kode OTP Anda: *{$otp}*\n"
            . "Berlaku 5 menit.\n\n"
            . "JANGAN berikan kode ini ke siapa pun.";

        Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN'),
        ])->post('https://api.fonnte.com/send', [
                'target'  => $phone,
                'message' => $message,
                'countryCode' => '62',
            ]);
    }
}
