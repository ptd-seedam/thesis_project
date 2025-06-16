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
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id('BR_ID'); // Primary Key BR_ID
            $table->date('BR_DATE');
            $table->date('BR_DUE_DATE');
            $table->date('BR_RETURN_DATE')->nullable(); // Nullable if book is not yet returned
            $table->string('BR_STATUS')->default('borrowed'); // e.g., 'borrowed', 'returned', 'overdue'

            // Foreign Keys
            // B_U (1,n) - USERS (1,1)
            $table->foreignId('U_ID')->constrained('users', 'U_ID')->onDelete('cascade');
            // B_BR (1,1) - BOOKS (1,n) (It seems this is a typo in the CDM, should be Books (1,n) - Borrowings (1,1))
            $table->foreignId('B_ID')->constrained('books', 'B_ID')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
