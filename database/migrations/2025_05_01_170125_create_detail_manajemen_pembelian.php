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
        Schema::create('detail_manajemen_pembelian', function (Blueprint $table) {
            $table->id('id_detail');
            $table->unsignedBigInteger('id_pembelian');
            $table->unsignedBigInteger('id_pupuk');
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 10, 2);

            $table->foreign('id_pembelian')->references('id_pembelian')->on('manajemen_pembelian')->onDelete('cascade');
            $table->foreign('id_pupuk')->references('id_pupuk')->on('pupuk')->onDelete('cascade');
    
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
