<?php


namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Models\City;

class CityRepository extends BaseRepository implements CityRepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
       return City::class;
    }
}
