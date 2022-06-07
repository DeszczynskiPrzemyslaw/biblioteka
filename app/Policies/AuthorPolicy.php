<?php

namespace App\Policies;

use App\Models\Author;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuthorPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->is_admin;
    }

    public function update(User $user, Author $author)
    {
        return $user->is_admin;
    }

    public function delete(User $user, Author $author)
    {
        return $user->is_admin;
    }
}
