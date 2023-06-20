<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Domain\Movie\DomainService\MovieDomainService;

class MovieController extends Controller
{
    private MovieDomainService $movieDomainservice;

    public function __construct(
        MovieDomainService $movieDomainservice
    ) {
        $this->movieDomainservice = $movieDomainservice;
    }

    public function index()
    {
        $movies = $this->movieDomainservice->getMovies();

        return view('movie.index', ['movies' => $movies]);
    }

    public function detail(int $id)
    {
        $movie = $this->movieDomainservice->getMovieFromId($id);

        return view('movie.detail', ['movie' => $movie]);
    }
}
