<?php


namespace App\Repositories\Eloquent;
use App\Models\Cvrecruitment;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\CvrecruitmentRepositoryInterface;

class CvrecruitmentRepository extends BaseRepository implements CvrecruitmentRepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Cvrecruitment::class;
    }
}
