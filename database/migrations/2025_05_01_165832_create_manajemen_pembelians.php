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
            $table->foreignId('id_pemasok')->constrained('pemasoks', 'id_pemasok')->onDelete('cascade');
            $table->integer('total_harga');
            $table->enum('status', ['pending', 'validated', 'rejected']);
            $table->date('tanggal_pembelian');
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
            $table->timestamps();
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
