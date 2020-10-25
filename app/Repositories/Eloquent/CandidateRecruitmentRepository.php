<?php


namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\CandidateRecruitmentRepositoryInterface;
use App\Models\CandidateRecruitment;

class CandidateRecruitmentRepository extends BaseRepository implements CandidateRecruitmentRepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return CandidateRecruitment::class;
    }
}
