<?php


namespace App\Repositories\Interfaces;


interface RecruitmentRepositoryInterface
{
    public function getRecruitmentOrder();

    public function getRecruitment();

    public function getRecruitmentById($id);

    public function getRecruitmentsByEmployerId($id);

    public function getRecruitmentByUserId($id);

    public function getCandidateByUserId($id);

    public function getRecruitmentEdit($id);
}
