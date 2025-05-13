<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Migration untuk users dan password_resets
public function up(): void
{
    Schema::create('users', function (Blueprint $table) {
        $table->id('id_user');
        $table->string('nama_user')->nullable();
        $table->string('email')->nullable();
        $table->string('password')->nullable();
        $table->enum('role', ['owner', 'manager', 'kepala_admin', 'kepala_gudang'])->default('owner');
        $table->rememberToken();
        $table->timestamps();
    });

    // Gunakan tabel password_resets yang sudah ada di Laravel
    Schema::create('password_resets', function (Blueprint $table) {
        $table->string('email')->index();
        $table->string('token');
        $table->timestamp('created_at')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
