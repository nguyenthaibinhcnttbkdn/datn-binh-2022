<?php


namespace App\Repositories\Eloquent;

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
}
