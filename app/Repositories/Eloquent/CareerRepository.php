<?php


namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\CareerRepositoryInterface;
use App\Models\Career;

class CareerRepository extends BaseRepository implements CareerRepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Career::class;
    }
}
