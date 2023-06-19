<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\StoreMovieHistoryRequest;

use App\Domain\Movie\DomainService\MovieDomainService;
use App\Domain\MovieHistory\DomainService\MovieHistoryDomainService;

class MovieHistoryController extends Controller
{
    private MovieDomainService $movieDomainservice;
    private MovieHistoryDomainService $movieHistoryDomainservice;

    public function __construct(
        MovieDomainService $movieDomainservice,
        MovieHistoryDomainService $movieHistoryDomainservice
    ) {
        $this->movieDomainservice = $movieDomainservice;
        $this->movieHistoryDomainservice = $movieHistoryDomainservice;
    }
    public function create()
    {
        return view('movie.create');
    }

    public function save(StoreMovieHistoryRequest $request)
    {
        $params = $request->validated();
        $params['category_id'] = 1;
        $userId = 1;

        $movieId = $this->movieDomainservice->storeMovie($params);
        
        $params['movie_id'] = $movieId;
        $this->movieHistoryDomainservice->storeMovieHistory($params);

        return redirect()->route('profile', ['id' => $userId]);
    }
}
