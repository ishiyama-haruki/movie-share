<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\UpdateUserRequest;

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

    public function updateForm()
    {
        return view('user.update');
    }

    public function update(int $id, UpdateUserRequest $request)
    {
        $params = $request->validated();

        if ($request->hasFile('image')) { 
            $img_path = $request->file('image')->store('public/profile');
            $img_path = str_replace('public', 'storage', $img_path);
            $params['img_path'] = $img_path;
        }

        $this->userDomainservice->updateUser($id, $params);

        return redirect()->route('profile', ['id' => $id])->with('flash_message', 'プロフィールを更新したよ!');
    }

    public function getHistory(int $id)
    {
        $response = $this->movieHistoryDomainservice->getMovieTitlesFromUserId($id);
        return $response;
    }
}
