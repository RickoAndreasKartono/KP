<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
     public function kelola_user(Request $request)
    {
        // Mendapatkan kata kunci pencarian dari input
        $search = trim($request->get('search'));

        // Query builder untuk users
        $query = User::query();

        // Jika ada query pencarian dan tidak kosong, tambahkan kondisi pencarian
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('nama_user', 'LIKE', '%' . $search . '%')
                  ->orWhere('email', 'LIKE', '%' . $search . '%');
            });
        }

        // Ambil hasil pencarian dengan pagination
        $users = $query->orderBy('nama_user', 'asc')->paginate(10); // gunakan paginate untuk mempermudah navigasi hasil

        // Kembalikan ke tampilan dengan data users dan search term
        return view('owner.kelola_user', compact('users', 'search'));
    }

    
    // Method untuk tambah user
    public function tambah_user()
    {
        return view('tambah_user');
    }
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
        'role' => 'required|string|in:manager,kepala_admin,kepala_gudang',
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
public function destroy($id_user)
{
    $user = User::findOrFail($id_user);

    // Cek jika user adalah owner, jangan dihapus
    if ($user->role === 'owner') {
        return redirect()->route('kelola_user')->with('error', 'Owner user tidak dapat dihapus.');
    }



    $user->delete();

    // Redirect setelah menghapus
    return redirect()->route('kelola_user')->with('success', 'User berhasil dihapus!');
}


    // Menampilkan halaman Edit User
    public function edit($id_user)
    {
        $user = User::findOrFail($id_user);
        
        return view('owner.edit_user', compact('user'));
    }
    

    // Memperbarui data User
   public function update_user(Request $request, $id_user)
{
    $user = User::findOrFail($id_user);

    $user->role = $request->role;
    $user->save();

    return redirect()->route('kelola_user')->with('success', 'Peran berhasil diperbarui.');
}
    
}