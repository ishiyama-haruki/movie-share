<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use \App\Http\Requests\StoreMovieHistoryRequest;
use \App\Http\Requests\UpdateMovieHistoryRequest;

use App\Domain\Movie\DomainService\MovieDomainService;
use App\Domain\MovieHistory\DomainService\MovieHistoryDomainService;
use App\Domain\Interest\DomainService\InterestDomainService;

class MovieHistoryController extends Controller
{
    private MovieDomainService $movieDomainservice;
    private MovieHistoryDomainService $movieHistoryDomainservice;
    private InterestDomainService $interestDomainservice;

    public function __construct(
        MovieDomainService $movieDomainservice,
        MovieHistoryDomainService $movieHistoryDomainservice,
        InterestDomainService $interestDomainservice
    ) {
        $this->movieDomainservice = $movieDomainservice;
        $this->movieHistoryDomainservice = $movieHistoryDomainservice;
        $this->interestDomainservice = $interestDomainservice;
    }
    
    public function create()
    {
        return view('movie.create');
    }

    public function save(StoreMovieHistoryRequest $request)
    {
        $params = $request->validated();
        $params['category_id'] = 1;
        $userId = Auth::id();

        $movieId = $this->movieDomainservice->storeMovie($params);
        
        $params['movie_id'] = $movieId;
        $params['user_id'] = $userId;

        $this->interestDomainservice->deleteExistInterest($params);
        
        $this->movieHistoryDomainservice->storeMovieHistory($params);

        return redirect()->route('profile', ['id' => $userId]);
    }

    public function detail(int $id)
    {
        $movieHistory = $this->movieHistoryDomainservice->getHistoryFromId($id);

        return view('movieHistory.detail', ['movieHistory' => $movieHistory]);
    }

    public function update(int $id, UpdateMovieHistoryRequest $request)
    {
        $params = $request->validated();
        $this->movieHistoryDomainservice->updateMovieHistory($id, $params);

        return redirect()->route('historyDetail', ['id' => $id])->with('flash_message', '更新が完了しました');
    }

    public function delete(int $id)
    {
        $this->movieHistoryDomainservice->deleteMovieHistory($id);

        $userId = Auth::id();
        return redirect()->route('profile', ['id' => $userId])->with('flash_message', '削除が完了しました');
    }
}
