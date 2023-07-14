<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Movie;

use App\Domain\Movie\DomainService\MovieDomainService;
use App\Domain\Interest\DomainService\InterestDomainService;

class MovieController extends Controller
{
    private MovieDomainService $movieDomainservice;
    private InterestDomainService $interestDomainservice;


    public function __construct(
        MovieDomainService $movieDomainservice,
        InterestDomainService $interestDomainservice
    ) {
        $this->movieDomainservice = $movieDomainservice;
        $this->interestDomainservice = $interestDomainservice;
    }

    public function index()
    {
        $movies = $this->movieDomainservice->getMovies();

        return view('movie.index', ['movies' => $movies, 'search' => false]);
    }

    public function search(Request $request)
    {
        $params = $request->all();
        $movies = $this->movieDomainservice->searchMovies($params);
        
        return view('movie.index', ['movies' => $movies, 'search' => true]);
    }

    public function detail(int $id)
    {
        $movie = $this->movieDomainservice->getMovieFromId($id);

        $params = [
            'movie_id' => $id,
            'user_id' => Auth::id()
        ];
        $interestId = $this->interestDomainservice->existInterest($params);

        return view('movie.detail', ['movie' => $movie, 'interestId' => $interestId]);
    }

    public function interest(int $id)
    {
        $params = [
            'movie_id' => $id,
            'user_id' => Auth::id()
        ];
        $this->interestDomainservice->storeInterest($params);

        return redirect()->route('movieDetail', ['id' => $id])->with('flash_message', '気になるリストに追加しました！');
    }
}
