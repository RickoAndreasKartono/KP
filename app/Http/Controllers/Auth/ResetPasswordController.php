<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function showResetForm()
    {
        return view('reset_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:user,email',
            'password' => 'required|min:8|confirmed', // Optional: Use confirmed if password confirmation is needed
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('login')->with('success', 'Password reset successfully!');
        }

        return back()->withErrors(['email' => 'User not found!']);
    }
}
