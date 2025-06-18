<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Menampilkan halaman utama Kelola User.
     * Anda mungkin punya method seperti ini untuk menampilkan daftar user.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Logika pencarian tidak berubah
        if ($request->has('search') && $request->search != '') {
        $searchTerm = strtolower($request->search);
        $query->whereRaw('LOWER(nama_user) LIKE ?', ['%' . $searchTerm . '%']);
}

        // TIDAK PERLU FILTER `whereNull('deleted_at')`
        // Laravel sudah melakukannya secara otomatis.
        $users = $query->latest()->get(); // atau paginate()

        return view('owner.kelola_user', compact('users'));
    }

    // Method `create` dan `store` tidak berubah.
    public function create()
    {
        return view('owner.kelola_user.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:70',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', 
            'role' => 'required|in:manager,kepala_admin,kepala_gudang',
        ]);

        User::create([
            'nama_user' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('owner.kelola_user')->with('success', 'User berhasil ditambahkan.');
    }

    // Method `updateRole` dan `updateProfile` tidak berubah.
    public function updateRole(Request $request, $id_user)
    {
        // ... logika tidak berubah
        $user = User::findOrFail($id_user);
        $user->role = $request->role;
        $user->save();
        return redirect()->back()->with('success', 'Role user berhasil diperbarui.');
    }

    public function updateProfile(Request $request)
    {

        $request->validate([
            'nama_user' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->nama_user = $request->nama_user;

        $user->save();

         return redirect()->back()->with('success', 'Perubahan berhasil disimpan!');
    }

    /**
     * PERUBAHAN DI SINI (Hanya Pesan Sukses)
     * Method ini sekarang melakukan soft delete.
     */
    public function destroy($id_user)
    {
        $user = User::findOrFail($id_user);
        $user->delete(); // Ini akan menjalankan SOFT DELETE

        // Ganti pesan agar lebih sesuai.
        return redirect()->back()->with('success', 'User berhasil dinonaktifkan/dipindahkan ke arsip.');
    }
}