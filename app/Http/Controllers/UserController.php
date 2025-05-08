<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan daftar pengguna
    public function index()
    {
        $users = User::all();  // Ambil semua data user
        return view('user.index', compact('users')); // Menampilkan daftar user
    }

    // Menampilkan form untuk membuat pengguna baru
    public function create()
    {
        return view('user.create');  // Tampilkan form pembuatan user
    }

    // Menyimpan pengguna baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_user' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',  // Pastikan password dikonfirmasi
            'role' => 'required|in:owner,manager,kepala_admin,kepala_gudang',
        ]);

        // Membuat user baru
        User::create([
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    // Menampilkan form untuk mengedit pengguna
    public function edit($id)
    {
        $user = User::findOrFail($id);  // Mencari user berdasarkan ID
        return view('user.edit', compact('user'));  // Tampilkan form edit
    }

    // Mengupdate data pengguna
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_user' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,  // Validasi email kecuali pengguna yang sama
            'password' => 'nullable|min:6|confirmed',  // Password bisa kosong
            'role' => 'required|in:owner,manager,kepala_admin,kepala_gudang',
        ]);

        $user = User::findOrFail($id);  // Cari pengguna berdasarkan ID

        // Update data pengguna
        $user->nama_user = $request->nama_user;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);  // Jika password diubah, hash password baru
        }
        $user->role = $request->role;
        $user->save();  // Simpan perubahan

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    // Menghapus pengguna
    public function destroy($id)
    {
        $user = User::findOrFail($id);  // Cari pengguna berdasarkan ID
        $user->delete();  // Hapus pengguna

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
