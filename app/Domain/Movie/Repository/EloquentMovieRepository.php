<?php

namespace App\Domain\Movie\Repository;

use App\Models\Movie;

class EloquentMovieRepository
{
    private Movie $eloquentMovie;

    public function __construct(
        Movie $eloquentMovie
    ) {
        $this->eloquentMovie = $eloquentMovie;
    }

    public function getMovies()
    {
        $eloquentMovies = $this->eloquentMovie->paginate(10);
        return $eloquentMovies;
    }

    public function searchMovies($params)
    {
        $eloquentMovies = $this->eloquentMovie->where('title', 'like', '%' . $params['title'] . '%')
                                                ->orWhere('original_title', 'like', '%' . $params['title'] . '%')
                                                ->get();

        return $eloquentMovies;
    }

    public function getMovieFromId($id)
    {   
        return $this->eloquentMovie->findOrFail($id);
    }

    public function checkExist($params)
    {
        $movieQuery = $this->eloquentMovie->where('title', $params['title'])
                                ->where('release_date', $params['release_date']);

        if ($movieQuery->count() > 0) {
            return $movieQuery->first()->id;
        }

        return null;
    }

    public function storeMovie($params)
    {
        $movie = new $this->eloquentMovie;
        $movie->fill($params)->save();

        return $movie->id;
    }
}