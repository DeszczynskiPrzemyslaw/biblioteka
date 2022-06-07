<?php

namespace App\Policies;

use App\Models\Genre;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GenrePolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->is_admin;
    }

    public function update(User $user, Genre $genre)
    {
        return $user->is_admin;
    }

    public function delete(User $user, Genre $genre)
    {
        return $user->is_admin;
    }
}
