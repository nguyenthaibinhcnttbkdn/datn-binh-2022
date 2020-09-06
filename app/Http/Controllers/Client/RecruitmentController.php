<?php

namespace App\Http\Controllers\Client;

use App\Repositories\Interfaces\RecruitmentRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecruitmentController extends Controller
{
    private $recruitmentRepository;

    public function __construct(RecruitmentRepositoryInterface $recruitmentRepository)
    {
        $this->recruitmentRepository = $recruitmentRepository;
    }

    public function getRecruitmentOrder()
    {
        $data   = $this->recruitmentRepository->getRecruitmentOrder()->get()->toArray();
        return $this->sendResult(true, 'Show Successfully', $data, 200);
    }
}
