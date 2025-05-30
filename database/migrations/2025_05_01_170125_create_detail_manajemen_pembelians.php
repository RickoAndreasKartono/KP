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
            $table->foreignId('id_pembelian')->constrained('manajemen_pembelians', 'id_pembelian')->onDelete('cascade');
            $table->foreignId('id_pupuk')->constrained('pupuks', 'id_pupuk')->onDelete('cascade');
            $table->integer('jumlah');
            $table->integer('harga_satuan');
            $table->timestamps();
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
