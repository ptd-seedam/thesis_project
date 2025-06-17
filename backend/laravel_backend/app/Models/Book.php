<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $primaryKey = 'B_ID';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'B_TITLE',
        'B_PUBLIC_DATE',
        'B_TOTAL_COPIES',
        'B_AVAILABLE_COPIES',
        'B_RATE',
        'B_TOTAL_READ',
        'B_IMAGE',
        'C_ID', // Foreign key
        'A_ID', // Foreign key
        'P_ID', // Foreign key
    ];

    protected $casts = [
        'B_PUBLIC_DATE' => 'date',
    ];

    /**
     * Get the author that wrote the book.
     */
    public function author()
    {
        // Một sách thuộc về một tác giả
        return $this->belongsTo(Author::class, 'A_ID', 'A_ID');
    }

    /**
     * Get the category that the book belongs to.
     */
    public function category()
    {
        // Một sách thuộc về một thể loại
        return $this->belongsTo(Category::class, 'C_ID', 'C_ID');
    }

    /**
     * Get the publisher that published the book.
     */
    public function publisher()
    {
        // Một sách được xuất bản bởi một nhà xuất bản
        return $this->belongsTo(Publisher::class, 'P_ID', 'P_ID');
    }

    /**
     * Get the borrowings for the book.
     */
    public function borrowings()
    {
        // Một sách có thể có nhiều lượt mượn
        return $this->hasMany(Borrowing::class, 'B_ID', 'B_ID');
    }
}
