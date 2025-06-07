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
            $table->unsignedBigInteger('id_pemasok');
            $table->integer('total_harga');
            $table->enum('status', ['pending', 'validated', 'rejected']);
            $table->date('tanggal_pembelian');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_pemasok')->references('id_pemasok')->on('pemasoks')->onDelete('cascade');
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
