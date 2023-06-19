<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Domain\User\DomainService\UserDomainService;
use App\Domain\MovieHistory\DomainService\MovieHistoryDomainService;

class UserController extends Controller
{
    private UserDomainService $userDomainservice;
    private MovieHistoryDomainService $movieHistoryDomainservice;

    public function __construct(
        UserDomainService $userDomainservice,
        MovieHistoryDomainService $movieHistoryDomainservice
    ) {
        $this->userDomainservice = $userDomainservice;
        $this->movieHistoryDomainservice = $movieHistoryDomainservice;
    }
    
    public function detail($id)
    {
        $user = $this->userDomainservice->getUserFromId($id);
        $movieHistories = $this->movieHistoryDomainservice->getMovieHistoriesFromUserId($id);

        return view('user.detail', ['user' => $user, 'movieHistories' => $movieHistories]);
    }
}
