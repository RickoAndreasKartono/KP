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
        Schema::create('stok_keluars', function (Blueprint $table) {
            $table->id('id_stok_keluar');
            $table->unsignedBigInteger('id_pupuk');
            $table->integer('jumlah_keluar');
            $table->string('tujuan');
            $table->date('tanggal_keluar');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_pupuk')->references('id_pupuk')->on('pupuks')->onDelete('cascade');
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_keluar');
    }
};
