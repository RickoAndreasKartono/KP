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
        Schema::create('pemasok', function (Blueprint $table) {
            $table->id('id_pemasok');
            $table->string('nama_pemasok', 100);
            $table->text('alamat');
            $table->string('no_telp', 15);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasok');
    }
};
