<?php


namespace App\Repositories\Eloquent;

use App\Models\Candidate;
use App\Models\CurriculumVitae;
use App\Repositories\Interfaces\CurriculumVitaeRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;


class CurriculumVitaeRepository extends BaseRepository implements CurriculumVitaeRepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return CurriculumVitae::class;
    }

    public function getCurriculumVitaeByUserId($id)
    {
        $candidateId = Candidate::where('user_id', $id)->get()->toArray()[0]['id'];
        $curriculumVitae = CurriculumVitae::where('candidate_id', $candidateId)->get()->toArray();
        return $curriculumVitae;
    }

    public function getCurriculumVitaeByCandidateId($id)
    {
        $curriculumVitae = CurriculumVitae::where('candidate_id', $id)->get()->toArray();
        return $curriculumVitae;
    }

    public function getCurriculumVitaeById($id)
    {
        $curriculumVitae = CurriculumVitae::where('id', $id)->get()->toArray();
        return $curriculumVitae;
    }
}
