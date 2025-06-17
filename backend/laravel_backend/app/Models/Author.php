<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors'; // Tên bảng trong database
    protected $primaryKey = 'A_ID'; // Khóa chính của bảng
    public $incrementing = true; // Khóa chính có tự động tăng không
    protected $keyType = 'int'; // Kiểu dữ liệu của khóa chính

    protected $fillable = [
        'A_NAME',
        'A_DESCRIPTION',
    ];

    /**
     * Get the books by this author.
     */
    public function books()
    {
        // Một tác giả có thể có nhiều sách
        return $this->hasMany(Book::class, 'A_ID', 'A_ID');
    }
}
