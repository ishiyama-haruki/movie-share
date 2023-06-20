<?php

namespace App\Domain\MovieHistory\DomainService;

use App\Domain\MovieHistory\Repository\EloquentMovieHistoryRepository;

final class MovieHistoryDomainService
{
    private EloquentMovieHistoryRepository $movieHistoryRepo;

    private const PER_PAGE = 50;

    public function __construct(
        EloquentMovieHistoryRepository $movieHIstoryRepo
    ) {
        $this->movieHistoryRepo = $movieHIstoryRepo;
    }

    public function storeMovieHistory($params)
    {
        return $this->movieHistoryRepo->storeMovieHistory($params);
    }

    public function getMovieHistoriesFromUserId($userId)
    {
        return $this->movieHistoryRepo->getMovieHistoriesFromUserId($userId);
    }

    public function getHistoryFromId($id)
    {
        return $this->movieHistoryRepo->getHistoryFromId($id);
    }

    public function updateMovieHistory($id, $params)
    {
        return $this->movieHistoryRepo->updateMovieHistory($id, $params);
    }

    public function deleteMovieHistory($id)
    {
        return $this->movieHistoryRepo->deleteMovieHistory($id);
    }

}