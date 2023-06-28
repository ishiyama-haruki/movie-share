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

    public function getMovieTitlesFromUserId($userId)
    {
        $movieHistories = $this->eloquentMovieHistory->where('user_id', $userId)->get();

        $movieTitles = [];
        foreach ($movieHistories as $movieHistory) {
            $movieTitles[] = $movieHistory->movie->title;
        }
        return $movieTitles;
    }

    public function getHistoryFromId($id)
    {
        return $this->eloquentMovieHistory->findOrFail($id);
    }

    public function updateMovieHistory($id, $params)
    {
        $movieHistory = $this->eloquentMovieHistory->findOrFail($id);
        $movieHistory->fill($params)->save();

        return $id;
    }

    public function deleteMovieHistory($id)
    {
        return $this->eloquentMovieHistory->findOrFail($id)->delete();
    }
}