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
        Schema::create('manajemen_pembelian', function (Blueprint $table) {
            $table->id('id_pembelian');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_pemasok');
            $table->decimal('total_harga', 10, 2);
            $table->enum('status', ['pending', 'validated', 'rejected']);
            $table->timestamp('tanggal_pembelian');

            $table->foreign('id_pemasok')->references('id_pemasok')->on('pemasok')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manajemen_pembelian');
    }
};
