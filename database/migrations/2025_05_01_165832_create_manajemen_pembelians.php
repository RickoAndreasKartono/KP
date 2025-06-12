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
        Schema::create('manajemen_pembelians', function (Blueprint $table) {
            $table->id('id_pembelian');
            $table->string('nama_pupuk');
            $table->integer('jumlah');
            $table->string('satuan');
            $table->string('pemasok');
            $table->enum('status', ['pending', 'validated', 'rejected'])->default('pending');
            $table->date('tanggal_pembelian');
            $table->unsignedBigInteger('id_user');

            $table->timestamps();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the table if it exists (typo corrected from 'manajemen_pembelian')
        Schema::dropIfExists('manajemen_pembelians');
    }
};
