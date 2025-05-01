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
        Schema::create('validasi_transaksi', function (Blueprint $table) {
            $table->id('id_validasi');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_pembelian');
            $table->unsignedBigInteger('id_stok_keluar');
            $table->enum('status_validasi', ['pending', 'approved', 'rejected']);
            $table->timestamp('tanggal_validasi');

            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
            $table->foreign('id_pembelian')->references('id_pembelian')->on('manajemen_pembelian')->onDelete('cascade');
            $table->foreign('id_stok_keluar')->references('id_stok_keluar')->on('stok_keluar')->onDelete('cascade');
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
