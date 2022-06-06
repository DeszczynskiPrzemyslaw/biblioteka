<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property string $date_of_creation
 * @property string $ISBN
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Book extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'date_of_creation',
        'ISBN',
    ];


    public function isBorrowed(int $id): bool
    {
        $book = Book::firstWhere('id', $id);
        if (!$book->pivot->date_of_borrowing) {
            return true;
        }

        return false;
    }


    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('date_of_borrowing', 'date_of_return');
    }
}
