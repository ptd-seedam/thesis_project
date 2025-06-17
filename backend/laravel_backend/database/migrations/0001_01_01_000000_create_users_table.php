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
            $table->id('U_ID'); // Primary Key U_ID
            $table->string('U_NAME');
            $table->string('U_PHONE')->nullable();
            $table->string('U_ADDRESS')->nullable();
            $table->string('U_ROLE')->default('user'); // e.g., 'admin', 'librarian', 'user'
            $table->string('U_TOKEN')->nullable()->unique(); // For API tokens, reset password tokens, etc.
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken(); // For "remember me" functionality
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
