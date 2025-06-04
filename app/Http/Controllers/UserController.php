<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        // View form tambah user
        return view('owner.kelola_user.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:manager,kepala_admin,kepala_gudang',
        ]);

        User::create([
            'nama_user' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('kelola_user')->with('success', 'User berhasil ditambahkan.');
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:manager,kepala_admin,kepala_gudang',
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'Role user diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User dihapus.');
    }

    
}
