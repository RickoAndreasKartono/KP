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
            $table->unsignedBigInteger('id_pembelian')->nullable;
            $table->unsignedBigInteger('id_stok_keluar')->nullable();
            $table->enum('status_validasi', ['pending', 'validated', 'rejected']);
            $table->unsignedBigInteger('id_user');
            $table->date('tanggal_validasi');
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_pembelian')->references('id_pembelian')->on('manajemen_pembelians')->onDelete('cascade');
            $table->foreign('id_stok_keluar')->references('id_stok_keluar')->on('stok_keluars')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
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
