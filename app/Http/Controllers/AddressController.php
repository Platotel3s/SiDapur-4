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
        Addresses::create([
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
    public function hapusAlamat($id) {
        $pilihAlamat=Addresses::findOrFail($id);
        $pilihAlamat->delete();
        return redirect()->route('alamat.index')->with('success','Berhasil menghapus alamat');
    }
    public function edit($id) {
        $pilihAlamat=Addresses::findOrFail($id);
        return view('customer.address.edit',compact('pilihAlamat'));
    }

    public function update(Request $request, $id) {
        $pilihAlamat=Addresses::findOrFail($id);
        $request->validate([
            'label' => 'string',
            'namaPenerima' => 'string',
            'nomorPenerima' => 'string',
            'alamat' => 'string',
            'kota' => 'string',
            'provinsi' => 'string',
            'kodePos' => 'string',
        ]);
        $pilihAlamat->update([
            'label'=>$request->label,
            'namaPenerima'=>$request->namaPenerima,
            'alamat'=>$request->alamat,
            'kota'=>$request->kota,
            'provinsi'=>$request->provinsi,
            'kodePos'=>$request->kodePos,
        ]);
        return redirect()->route('alamat.index')->with('success','Berhasil memperbarui alamat '.$pilihAlamat->label);
    }
}
