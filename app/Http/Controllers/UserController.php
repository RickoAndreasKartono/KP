<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

        return redirect()->route('owner.kelola_user')->with('success', 'User berhasil ditambahkan.');
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

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User dihapus.');
    }

    
}