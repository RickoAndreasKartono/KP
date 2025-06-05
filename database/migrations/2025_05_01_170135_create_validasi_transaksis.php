<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('validasi_transaksis', function (Blueprint $table) {
            $table->id('id_validasi');
            $table->foreignId('id_pembelian')->nullable()->constrained('manajemen_pembelians', 'id_pembelian')->onDelete('cascade');
            $table->foreignId('id_stok_keluar')->nullable()->constrained('stok_keluars', 'id_stok_keluar')->onDelete('cascade');
            $table->enum('status_validasi', ['pending', 'validated', 'rejected']);
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
            $table->date('tanggal_validasi');
            $table->timestamps();
        });


        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validasi_transaksi');
    }
};
