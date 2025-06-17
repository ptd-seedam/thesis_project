<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable // extends Authenticatable for authentication features
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'U_ID';

    public $incrementing = true;

    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'U_NAME',
        'U_PHONE',
        'U_ADDRESS',
        'U_ROLE',
        'U_TOKEN',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'U_PASSWORD',
        'U_TOKEN', // Treat U_TOKEN as password in case it's used for sensitive purposes
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'U_EMAIL_VERIFIED_AT' => 'datetime', // If you add email verification
        'U_PASSWORD' => 'hashed',
    ];

    /**
     * Get the borrowings for the user.
     */
    public function borrowings()
    {
        // Một người dùng có thể có nhiều lượt mượn
        return $this->hasMany(Borrowing::class, 'U_ID', 'U_ID');
    }

    /**
     * Get the fines for the user.
     */
    public function fines()
    {
        // Một người dùng có thể có nhiều tiền phạt
        return $this->hasMany(Fine::class, 'U_ID', 'U_ID');
    }
}
