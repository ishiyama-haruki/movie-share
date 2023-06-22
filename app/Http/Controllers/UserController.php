<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Domain\User\DomainService\UserDomainService;
use App\Domain\MovieHistory\DomainService\MovieHistoryDomainService;
use App\Domain\Interest\DomainService\InterestDomainService;

class UserController extends Controller
{
    private UserDomainService $userDomainservice;
    private MovieHistoryDomainService $movieHistoryDomainservice;
    private InterestDomainService $interestDomainservice;

    public function __construct(
        UserDomainService $userDomainservice,
        MovieHistoryDomainService $movieHistoryDomainservice,
        InterestDomainService $interestDomainservice
    ) {
        $this->userDomainservice = $userDomainservice;
        $this->movieHistoryDomainservice = $movieHistoryDomainservice;
        $this->interestDomainservice = $interestDomainservice;
    }
    
    public function detail($id)
    {
        $user = $this->userDomainservice->getUserFromId($id);
        $movieHistories = $this->movieHistoryDomainservice->getMovieHistoriesFromUserId($id);
        $interests = $this->interestDomainservice->getInterestsFromUserId($id);

        return view('user.detail', ['user' => $user, 'movieHistories' => $movieHistories, 'interests' => $interests]);
    }
}
