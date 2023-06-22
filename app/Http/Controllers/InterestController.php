<?php

namespace App\Http\Controllers;

use App\Domain\Interest\DomainService\InterestDomainService;

class InterestController extends Controller
{
    private InterestDomainService $interestDomainservice;


    public function __construct(
        InterestDomainService $interestDomainservice
    ) {
        $this->interestDomainservice = $interestDomainservice;
    }

    public function remove($id)
    {
        $movieId = $this->interestDomainservice->delete($id);

        return redirect()->route('movieDetail', ['id' => $movieId])->with('flash_message', '気になるリストから外しました！');
    }
}
