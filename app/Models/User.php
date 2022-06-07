<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int|null $email_verified_at
 * @property string $password
 * @property boolean $admin
 * @property string|null $remember_token
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(): bool
    {
        if ($this->admin == true) {
            return true;
        }

        return false;
    }

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class)->withPivot('date_of_borrowing', 'date_of_return');
    }

    public function borrowedBooks(): BelongsToMany
    {
        return $this->belongsToMany(Book::class)->withPivot('date_of_borrowing', 'date_of_return')->where(['date_of_borrowing']);
    }
}
