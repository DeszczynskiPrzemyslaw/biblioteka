<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;


    public function create(User $user)
    {
        return $user->is_admin;
    }

    public function update(User $user, Book $book)
    {
        return $user->is_admin;
    }

    public function delete(User $user, Book $book)
    {
        return $user->is_admin;
    }
}
