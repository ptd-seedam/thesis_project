<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasFactory;

    protected $table = 'fines';
    protected $primaryKey = 'F_ID';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'F_AMOUNT',
        'F_REASON',
        'F_ISSUED_DATE',
        'F_PAID_STATUS',
        'U_ID', // Foreign key
        'BR_ID', // Foreign key
    ];

    protected $casts = [
        'F_ISSUED_DATE' => 'date',
        'F_PAID_STATUS' => 'boolean',
    ];

    /**
     * Get the user that the fine belongs to.
     */
    public function user()
    {
        // Một khoản phạt thuộc về một người dùng
        return $this->belongsTo(User::class, 'U_ID', 'U_ID');
    }

    /**
     * Get the borrowing that the fine is associated with.
     */
    public function borrowing()
    {
        // Một khoản phạt thuộc về một lượt mượn
        return $this->belongsTo(Borrowing::class, 'BR_ID', 'BR_ID');
    }
}
