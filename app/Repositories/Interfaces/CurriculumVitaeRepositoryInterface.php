<?php


namespace App\Repositories\Interfaces;


interface CurriculumVitaeRepositoryInterface
{
    public function getCurriculumVitaeByUserId($id);

    public function getCurriculumVitaeByCandidateId($id);
}
