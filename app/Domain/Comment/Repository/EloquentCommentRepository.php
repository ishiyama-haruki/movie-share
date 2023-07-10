<?php

namespace App\Domain\Comment\Repository;

use App\Models\Comment;

class EloquentCommentRepository
{
    private Comment $eloquentComment;

    public function __construct(
        Comment $eloquentComment
    ) {
        $this->eloquentComment = $eloquentComment;
    }

    public function store($params)
    {
        $comment = new $this->eloquentComment;
        $comment->fill($params)->save();

        return $comment->id;
    }

    public function delete($id)
    {
        $comment = $this->eloquentComment->find($id);
        $movieHistoryId = $comment->movie_history_id;
        $comment->delete();

        return $movieHistoryId;
    }

}