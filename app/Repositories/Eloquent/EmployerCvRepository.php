<?php


namespace App\Repositories\Eloquent;
use App\Models\EmployerCv;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\EmployerCvRepositoryInterface;

class EmployerCvRepository extends BaseRepository implements EmployerCvRepositoryInterface
{

    public function getModel()
    {
        return EmployerCv::class;
    }
}
