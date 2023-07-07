<?php

namespace App\Domain\Comment\DomainService;

use App\Domain\Comment\Repository\EloquentCommentRepository;

final class CommentDomainService
{
    private EloquentCommentRepository $commentRepo;

    public function __construct(
        EloquentCommentRepository $commentRepo
    ) {
        $this->commentRepo = $commentRepo;
    }

    public function store($params)
    {
        return $this->commentRepo->store($params);
    }

    public function delete($id)
    {
        return $this->commentRepo->delete($id);   
    }
}