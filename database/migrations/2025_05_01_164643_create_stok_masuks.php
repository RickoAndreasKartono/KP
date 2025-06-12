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
        Schema::create('stok_masuks', function (Blueprint $table) {
            $table->id('id_stok_masuk');
            $table->unsignedBigInteger('id_pupuk');
            $table->integer('jumlah_masuk');
            $table->date('tanggal_masuk');
            // Kolom id_pemasok dihapus
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_pupuk')->references('id_pupuk')->on('pupuks')->onDelete('cascade');
            // Foreign key untuk pemasok dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_masuks'); // Pastikan nama tabel sudah benar
    }
};
