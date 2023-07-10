<?php

namespace App\Domain\Movie\DomainService;

use App\Domain\Movie\Repository\EloquentMovieRepository;

final class MovieDomainService
{
    private EloquentMovieRepository $movieRepo;

    private const PER_PAGE = 50;

    public function __construct(
        EloquentMovieRepository $movieRepo
    ) {
        $this->movieRepo = $movieRepo;
    }

    public function storeMovie($params)
    {
        $movieId = $this->movieRepo->checkExist($params);
        if ($movieId) {
            return $movieId;
        } 

        return $this->movieRepo->storeMovie($params);
    }

    public function getMovies()
    {
        return $this->movieRepo->getMovies();
    }

    public function searchMovies($params)
    {
        return $this->movieRepo->searchMovies($params);
    }

    public function getMovieFromId($id)
    {
        return $this->movieRepo->getMovieFromId($id);
    }

}