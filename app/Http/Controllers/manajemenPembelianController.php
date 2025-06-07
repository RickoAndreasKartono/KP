<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class manajemenPembelianController extends Controller
{
   public function manajemenPembelian()
{
    // Hanya Owner dan Manager yang bisa mengelola pembelian
    if (!in_array(auth()->user()->role, ['owner', 'manager'])) {
        return redirect('/dashboard');
    }

    $purchases = Purchase::all();  // Ambil semua data pembelian
    return view('manajemen_pembelian.index', compact('purchases'));
}

public function createPembelian()
{
    return view('manajemen_pembelian.create');
}

public function storePembelian(Request $request)
{
    Purchase::create($request->all());
    return redirect()->route('manajemen_pembelian.index');
}

}
