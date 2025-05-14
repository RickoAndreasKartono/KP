<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan halaman Kelola User
    public function index()
    {
        // Mengambil semua data pengguna
        $users = User::all();
        return view('owner.kelola_user', compact('users'));
    }

    // Menampilkan halaman untuk menambah User
    public function create()
    {
        return view('owner.tambah_user');
    }

  public function store(Request $request)
{

    // Validasi data yang diterima dari form
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'role' => 'required|string|in:manager,kepala_admin, kepala_gudang',
    ]);

    // Membuat user baru dengan data yang telah divalidasi
    User::create([
        'nama_user' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password), // Mengenkripsi password
        'role' => $request->role,
    ]);

    // Redirect ke halaman kelola user dengan pesan sukses
    return redirect()->route('kelola_user')->with('success', 'User berhasil ditambahkan!');
}


    // Menghapus User berdasarkan ID
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        // Redirect setelah menghapus
        return redirect()->route('owner.kelola_user')->with('success', 'User berhasil dihapus!');
    }

    // Menampilkan halaman Edit User
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('owner.edit_user', compact('user'));
    }

    // Memperbarui data User
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|string',
            'status' => 'required|string',
        ]);

        // Cari User yang akan diupdate
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        // Redirect setelah update
        return redirect()->route('owner.kelola_user')->with('success', 'User berhasil diperbarui!');
    }
}
