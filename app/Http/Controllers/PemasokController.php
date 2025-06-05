<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PemasokController extends Controller
{
    public function create()
    {
        return view('kepala_admin.pemasok.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemasok' => 'required|string|max:255',
            'alamat' => 'required|email|unique:users,email',
            'telepon' => 'required|min:6',
        ]);

        User::create([
            'nama_pemasok' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        return redirect()->route('pemasok')->with('success', 'Pemasok berhasil ditambahkan.');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Pemasok dihapus.');
    }

    
}
