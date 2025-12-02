<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function indexCustomer()
    {
        $customer = User::where('role', 'customer')->paginate(5);

        return view('admin.users.index', compact('customer'));
    }

    public function destroyCustomer($id)
    {
        $pilih = User::findOrFail($id);
        $pilih->delete();

        return back()->with('success', 'Berhasil hapus customer '.$pilih->name);
    }
}
