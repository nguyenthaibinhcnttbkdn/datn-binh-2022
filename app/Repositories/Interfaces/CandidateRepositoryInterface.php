<?php

namespace App\Repositories\Interfaces;

interface CandidateRepositoryInterface
{
    //public function getCandidateById($id);

    public function getCandidateOrder();

    public function getCandidate();

    public function addCandidate(array $data);

    public function getCandidateByUserId($id);

    public function getRecruitmentByUserId($id);

    public function getCandidateAdmin();

    public function getJobApplyByUserId($id);
}
