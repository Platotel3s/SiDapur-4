<?php

namespace App\Http\Controllers;

use App\Models\Addresses;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = auth()->user()->alamat;

        return view('customer.address.index', compact('addresses'));
    }

    public function create()
    {
        return view('customer.address.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required',
            'namaPenerima' => 'required',
            'nomorPenerima' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'kodePos' => 'required',
        ]);
        $isDefault = auth()->user()->alamat()->count() == 0;
        $address = Addresses::create([
            'user_id' => auth()->id(),
            'label' => $request->label,
            'namaPenerima' => $request->namaPenerima,
            'nomorPenerima' => $request->nomorPenerima,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'kodePos' => $request->kodePos,
            'alamatUtama' => $isDefault,
        ]);

        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil ditambahkan!');
    }

    public function setUtama($id)
    {
        $user = auth()->user();
        $user->alamat()->update(['alamatUtama' => false]);
        $address = Addresses::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $address->update(['alamatUtama' => true]);

        return redirect()->back()->with('success', 'Alamat utama berhasil diubah!');
    }
}
