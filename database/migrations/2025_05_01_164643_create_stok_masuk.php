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
        Schema::create('stok_masuk', function (Blueprint $table) {
            $table->id('id_stok_masuk');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_pupuk');
            $table->integer('jumlah');
            $table->date('tanggal_masuk');
            $table->timestamps();
        
            // Foreign keys
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
            $table->foreign('id_pupuk')->references('id_pupuk')->on('pupuk')->onDelete('cascade');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_masuk');
    }
};
