<?php


namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\TypeOfWorkRepositoryInterface;
use App\Models\TypeOfWork;

class TypeOfWorkRepository extends BaseRepository implements TypeOfWorkRepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return TypeOfWork::class;
    }
}
