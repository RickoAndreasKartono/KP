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
            $table->string('nama_pupuk');
            $table->integer('jumlah');
            $table->string('satuan');
            
            // Kolom foreign key untuk pemasok
            $table->foreignId('id_pemasok')->nullable()
                  ->constrained('pemasoks', 'id_pemasok')
                  ->onDelete('set null');

            $table->enum('status', ['pending', 'validated', 'rejected'])->default('pending');
            $table->date('tanggal_pembelian');
            
            // Kolom foreign key untuk user
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');

            // HANYA SATU BARIS INI untuk created_at dan updated_at
            $table->timestamps(); 
            
            // HANYA SATU BARIS INI untuk soft delete
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manajemen_pembelians');
    }
};
