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
            $table->foreignId('id_pupuk')->constrained('pupuks', 'id_pupuk')->onDelete('cascade');
            $table->integer('jumlah_masuk');
            $table->date('tanggal_masuk');
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
            $table->timestamps();
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
