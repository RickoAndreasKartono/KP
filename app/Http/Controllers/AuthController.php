<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;
use Str;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\Password;
use App\Mail\ResetPasswordMail;
use Mail;

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

    public function forgot_post(Request $request )
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return back()->with(
            $status === Password::RESET_LINK_SENT
                ? ['status' => 'Link reset telah dikirimkan. Silakan periksa email kamu.']
                : ['email' => __($status)]
        );

    }

    // Handle logout
    public function logout()
    {
        Auth::logout();
        return redirect(url('login'));
    }

    public function showResetForm($token)
    {
        return view('auth.reset', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        \Log::info('Submit reset called'); // DEBUG LOG

        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', 'Password berhasil direset!')
                    : back()->withErrors(['email' => [__($status)]]);
        }

   
}

