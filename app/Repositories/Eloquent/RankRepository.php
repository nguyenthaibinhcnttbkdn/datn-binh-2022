<?php


namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\RankRepositoryInterface;
use App\Models\Rank;

class RankRepository extends BaseRepository implements RankRepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Rank::class;
    }
}
