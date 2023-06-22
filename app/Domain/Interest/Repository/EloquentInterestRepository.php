<?php

namespace App\Domain\Interest\Repository;

use App\Models\Interest;

class EloquentInterestRepository
{
    private Interest $eloquentInterest;

    public function __construct(
        Interest $eloquentInterest
    ) {
        $this->eloquentInterest = $eloquentInterest;
    }

    public function storeInterest($params)
    {
        $interest = new $this->eloquentInterest;
        $interest->fill($params)->save();

        return $interest->id;

    }

    public function getInterestsFromUserId($userId)
    {
        return $this->eloquentInterest->where('user_id', $userId)->get();
    }

    public function existInterest($params)
    {
        $exist = $this->eloquentInterest->where('user_id', $params['user_id'])->where('movie_id', $params['movie_id'])->first();
        if ($exist) {
            return $exist->id;
        }
        return null;
    }

    public function delete($id)
    {
        $eloquentInterest = $this->eloquentInterest->findOrFail($id);
        $movieId = $eloquentInterest->movie_id;
        $eloquentInterest->delete();

        return $movieId;
    }
}