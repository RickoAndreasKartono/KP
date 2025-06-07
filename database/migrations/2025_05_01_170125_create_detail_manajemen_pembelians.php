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
        Schema::create('detail_manajemen_pembelians', function (Blueprint $table) {
            $table->id('id_detail');
            $table->unsignedBigInteger('id_pembelian');
            $table->unsignedBigInteger('id_pupuk');
            $table->integer('jumlah');
            $table->integer('harga_satuan');
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_pupuk')->references('id_pupuk')->on('pupuks')->onDelete('cascade');
            $table->foreign('id_pembelian')->references('id_pembelian')->on('manajemen_pembelians')->onDelete('cascade');
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_manajemen_pembelian');
    }
};
