<?php

namespace App\Domain\MovieHistory\Repository;

use App\Models\MovieHistory;


class EloquentMovieHistoryRepository
{
    private MovieHistory $eloquentMovieHistory;

    public function __construct(
        MovieHistory $movieHistory
    ) {
        $this->eloquentMovieHistory = $movieHistory;
    }

    public function storeMovieHistory($params)
    {
        $movieHistory = new $this->eloquentMovieHistory;
        $movieHistory->fill($params)->save();

        return $movieHistory->id;
    }

    public function getMovieHistoriesFromUserId($userId)
    {
        $movieHistories = $this->eloquentMovieHistory->where('user_id', $userId)->get();
        return $movieHistories;
    }
}