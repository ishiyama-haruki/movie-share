<?php

namespace App\Domain\User\DomainService;

use App\Domain\User\Repository\EloquentUserRepository;

final class UserDomainService
{
    private EloquentUserRepository $userRepo;

    private const PER_PAGE = 50;

    public function __construct(
        EloquentUserRepository $userRepo
    ) {
        $this->userRepo = $userRepo;
    }

    public function getUserFromId($id)
    {
        return $this->userRepo->getUserFromId($id);
    }

    public function updateUser($id, $params)
    {
        return $this->userRepo->updateUser($id, $params);
    }
}