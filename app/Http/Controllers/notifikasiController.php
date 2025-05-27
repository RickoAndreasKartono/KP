<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class notifikasiController extends Controller
{
    public function kirimNotifikasi()
{
    // Semua peran bisa mengirimkan notifikasi pengingat
    $users = User::all();  // Ambil semua pengguna
    foreach ($users as $user) {
        // Logika pengiriman notifikasi
        Notification::send($user, new ReminderNotification());  // Mengirim notifikasi kepada setiap user
    }

    // Redirect ke halaman dashboard setelah notifikasi terkirim
    return redirect()->route('dashboard');
}

}
