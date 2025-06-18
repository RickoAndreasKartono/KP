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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nama_user', 50);
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['owner', 'manager', 'kepala_admin', 'kepala_gudang'])->default('owner');
            $table->boolean('is_active')->default(true);
            $table->rememberToken();
            $table->timestamps();

          
            $table->timestamp('deleted_at')->nullable();
        });

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
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('users');
    }
};