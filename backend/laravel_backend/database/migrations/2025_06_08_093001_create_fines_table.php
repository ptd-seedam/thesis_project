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
        Schema::create('fines', function (Blueprint $table) {
            $table->id('F_ID'); // Primary Key F_ID
            $table->decimal('F_AMOUNT', 8, 2); // Amount of the fine
            $table->text('F_REASON')->nullable();
            $table->date('F_ISSUED_DATE');
            $table->boolean('F_PAID_STATUS')->default(false); // True if paid, false otherwise

            $table->foreignId('BR_ID')->constrained('borrowings', 'BR_ID')->onDelete('cascade');
            $table->foreignId('U_ID')->constrained('users', 'U_ID')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fines');
    }
};
