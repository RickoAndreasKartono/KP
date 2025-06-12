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
        Schema::create('laporan_stoks', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->unsignedBigInteger('id_pupuk');
            $table->integer('total_masuk');
            $table->integer('total_keluar');
            $table->integer('stok_akhir');
            $table->timestamps();

            $table->foreign('id_pupuk')->references('id_pupuk')->on('pupuks')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_stoks');
    }
};
