<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Str;

class AuthController extends Controller
{

    // Show login form
    public function login()
    {
        return view('auth.login');
    }

    public function login_post(Request $request)
{
    // Validasi input
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Pengecekan role setelah login berhasil
        if (Auth::user()->role == 'owner') {
            return redirect()->intended('/stok_pupuk');
        } elseif (Auth::user()->role == 'manager') {
            return redirect()->intended('manager/stok_pupuk');
        } elseif (Auth::user()->role == 'kepala_admin') {
            return redirect()->intended('kepala_admin/stok_pupuk');
        } elseif (Auth::user()->role == 'kepala_gudang') {
            return redirect()->intended('kepala_gudang/stok_pupuk');
        } else {
            return redirect('login')->with('error', 'No available role for this user.');
        }
    } else {
        return redirect()->back()->with('error', 'Please enter the correct email and password.');
    }
}


    public function forgot(){
        return view('auth.forgot');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // Show user management form (for Owner only)
    public function manageUsers()
    {
        $this->authorize('manage-users'); // Add policy for Owner-only access
        
        $users = User::all();
        return view('dashboard.kelola_user', compact('users'));
    }

    // Create a new user
    public function storeUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:owner,manager,kepala_admin,kepala_gudang',
        ]);

        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('dashboard.kelola_user')->with('success', 'User created successfully.');
    }
}

