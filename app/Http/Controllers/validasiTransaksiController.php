<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class validasiTransaksiController extends Controller
{
    public function validasiTransaksi($id_user)
{
    // Hanya Owner dan Kepala Admin yang bisa melakukan validasi transaksi
    if (!in_array(auth()->user()->role, ['owner', 'kepala admin'])) {
        return redirect('/dashboard');
    }

    // Logika untuk validasi transaksi
    $transaction = Transaction::findOrFail($id);
    $transaction->validate();
    return redirect()->route('transaction.index');
}

public function ajukanValidasi($id)
{
    // Manager hanya bisa mengajukan permintaan validasi
    $transaction = Transaction::findOrFail($id);
    $transaction->requestValidation();
    return redirect()->route('transaction.index');
}

}
