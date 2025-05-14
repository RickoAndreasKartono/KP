<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
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
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) 
        {
            if(Auth::User()->role == 'owner')
            {
                return redirect()-> intended('owner/stok_pupuk');
            } 
            else if(Auth::User()->role == 'manager')
            {
                return redirect()-> intended('manager/stok_pupuk');
            } 
            else if(Auth::User()->role == 'kepala_admin')
            {
                return redirect()-> intended('kepala_admin/stok_pupuk');
            } 
            else if(Auth::User()->role == 'kepala_gudang')
            {
                return redirect()-> intended('kepala_gudang/stok_pupuk');
            } 
            else 
            {
                return redirect('login')->with('error', 'No avaibles email...');
            }
        }

        else {
            return redirect()->back()->with('error', 'Please enter the correct email and password');
        
        }
    }
    

    public function forgot(){
        return view('auth.forgot');
    }

    public function forgotPost(Request $request)
{
    // Validasi email
    $request->validate([
        'email' => 'required|email|exists:users,email', // Memastikan email terdaftar
    ]);

    // Kirimkan link reset password ke email
    $status = Password::sendResetLink($request->only('email'));

    if ($status == Password::RESET_LINK_SENT) {
        return back()->with('status', 'Reset link has been sent to your email!');
    } else {
        return back()->withErrors(['email' => 'No account found with that email address.']);
    }
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
       // Menangani reset password
public function resetPassword(Request $request)
{
    // Validasi password dan konfirmasinya
    $request->validate([
        'password' => 'required|confirmed|min:8', // Pastikan password valid dan konfirmasi sesuai
    ]);

    // Ambil user yang sedang login
    $user = Auth::user();
    $user->password = Hash::make($request->password); // Perbarui password
    $user->save(); // Simpan perubahan

    // Redirect ke login dengan pesan sukses
    return redirect()->route('login')->with('status', 'Password berhasil diperbarui!');
}
public function showResetForm($token)
{
    return view('auth.reset-password', ['token' => $token]);
}


}

