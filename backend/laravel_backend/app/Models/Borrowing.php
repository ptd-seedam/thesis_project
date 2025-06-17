<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $table = 'borrowings';
    protected $primaryKey = 'BR_ID';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'BR_DATE',
        'BR_DUE_DATE',
        'BR_RETURN_DATE',
        'BR_STATUS',
        'U_ID', // Foreign key
        'B_ID', // Foreign key
    ];

    protected $casts = [
        'BR_DATE' => 'date',
        'BR_DUE_DATE' => 'date',
        'BR_RETURN_DATE' => 'date',
    ];

    /**
     * Get the user that borrowed the book.
     */
    public function user()
    {
        // Một lượt mượn thuộc về một người dùng
        return $this->belongsTo(User::class, 'U_ID', 'U_ID');
    }

    /**
     * Get the book that was borrowed.
     */
    public function book()
    {
        // Một lượt mượn liên quan đến một cuốn sách
        return $this->belongsTo(Book::class, 'B_ID', 'B_ID');
    }

    /**
     * Get the fine associated with this borrowing (if any).
     */
    public function fine()
    {
        // Một lượt mượn có thể có một tiền phạt (hoặc không có)
        return $this->hasOne(Fine::class, 'BR_ID', 'BR_ID');
    }
}
