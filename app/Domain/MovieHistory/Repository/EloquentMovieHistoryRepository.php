<?php

namespace App\Domain\MovieHistory\Repository;

use App\Models\MovieHistory;
use App\Models\Comment;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class EloquentMovieHistoryRepository
{
    private MovieHistory $eloquentMovieHistory;
    private Comment $eloquentComment;

    public function __construct(
        MovieHistory $movieHistory,
        Comment $comment
    ) {
        $this->eloquentMovieHistory = $movieHistory;
        $this->eloquentComment = $comment;
    }

    public function storeMovieHistory($params)
    {
        $movieHistory = new $this->eloquentMovieHistory;
        $movieHistory->fill($params)->save();

        return $movieHistory->id;
    }

    public function getMovieHistoriesFromUserId($userId)
    {
        $movieHistories = $this->eloquentMovieHistory->where('user_id', $userId)->orderBy('viewing_date', 'DESC')->get();
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

    public function getMovieChartData()
    {
        $period = 5;

        $day = Carbon::today()->startOfMonth()->subMonths($period - 1);
        
        $chartData = [
            'labels' => [],
            'data' => []
        ];

        for ($i = 0; $i < $period; $i++) {
            $chartData['labels'][] = $day->format('Y-m');
            $chartData['data'][] = $this->eloquentMovieHistory->whereYear('viewing_date', $day->year)->whereMonth('viewing_date', $day->month)->count();

            $day->addMonth();
        }

        return $chartData;
    }

    public function commentToRead($id)
    {
        $movieHistory = $this->eloquentMovieHistory->findOrFail($id);
        if ($movieHistory->user_id != Auth::id()) {
            return;
        }
        return $this->eloquentComment->where('movie_history_id', $id)->update(['is_read' => 1]);
    }
}