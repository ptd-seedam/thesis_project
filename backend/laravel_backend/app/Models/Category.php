<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'C_ID';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'C_NAME',
        'C_DESCRIPTION',
    ];

    /**
     * Get the books belonging to this category.
     */
    public function books()
    {
        // Một thể loại có thể có nhiều sách
        return $this->hasMany(Book::class, 'C_ID', 'C_ID');
    }
}
