<?php

namespace App\Domain\Interest\DomainService;

use App\Domain\Interest\Repository\EloquentInterestRepository;

final class InterestDomainService
{
    private EloquentInterestRepository $interestRepo;

    private const PER_PAGE = 50;

    public function __construct(
        EloquentInterestRepository $interestRepo
    ) {
        $this->interestRepo = $interestRepo;
    }

    public function storeInterest($params)
    {
        $existId = $this->interestRepo->existInterest($params); 
        if ($existId) {
            return $existId;
        }
        return $this->interestRepo->storeInterest($params);
    }

    public function getInterestsFromUserId($userId)
    {
        return $this->interestRepo->getInterestsFromUserId($userId);
    }

    public function existInterest($params)
    {
        $existId = $this->interestRepo->existInterest($params);
        return $existId;
    }

    public function delete($id)
    {
        return $this->interestRepo->delete($id);
    }

    public function deleteExistInterest($params)
    {
        $existId = $this->interestRepo->existInterest($params); 
        if ($existId) {
            $this->interestRepo->delete($existId);
        }
        return;
    }
}