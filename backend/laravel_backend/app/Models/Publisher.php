<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    protected $table = 'publishers';
    protected $primaryKey = 'P_ID';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'P_NAME',
        'P_ADDRESS',
    ];

    /**
     * Get the books published by this publisher.
     */
    public function books()
    {
        // Một nhà xuất bản có thể xuất bản nhiều sách
        return $this->hasMany(Book::class, 'P_ID', 'P_ID');
    }
}
