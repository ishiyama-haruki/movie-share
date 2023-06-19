<?php

namespace App\Domain\User\Repository;

use App\Models\User;

class EloquentUserRepository
{
    private User $eloquentUser;

    public function __construct(
        User $eloquentUser
    ) {
        $this->eloquentUser = $eloquentUser;
    }

    public function getUserFromId($id)
    {
        return $this->eloquentUser->findOrFail($id);
    }
}