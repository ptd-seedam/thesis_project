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
        Schema::create('books', function (Blueprint $table) {
            $table->id('B_ID'); // Primary Key B_ID
            $table->string('B_TITLE');
            $table->date('B_PUBLIC_DATE')->nullable();
            $table->integer('B_TOTAL_COPIES')->default(0);
            $table->string('B_IMAGE')->nullable(); // Path to book cover image
            $table->integer('B_AVAILABLE_COPIES')->default(0);
            $table->float('B_RATE')->nullable(); // Average rating for the book
            $table->float('B_TOTAL_READ')->default(0); // Total times read or views

            // Foreign Keys
            // BOOK_CATEGORY (1,n) - BOOKS (1,1)
            $table->foreignId('C_ID')->constrained('categories', 'C_ID')->onDelete('cascade'); // Assuming B_CATEGORY is C_ID
            // BOOK_AUTHOR (1,n) - AUTHORS (1,1)
            $table->foreignId('A_ID')->constrained('authors', 'A_ID')->onDelete('cascade'); // Assuming A_ID is for main author
            // PUB_BOOK (1,1) - PUBLISHERS (1,1)
            $table->foreignId('P_ID')->constrained('publishers', 'P_ID')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
