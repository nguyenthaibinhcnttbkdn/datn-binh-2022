<?php

namespace App\Http\Controllers\Client;

use App\Models\CandidateRecruitment;
use App\Repositories\Interfaces\CandidateRecruitmentRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\DB;

class CandidateRecruitmentController extends Controller
{
    private $candidateRecruitmentRepository;

    public function __construct(CandidateRecruitmentRepositoryInterface $candidateRecruitmentRepository)
    {
        $this->candidateRecruitmentRepository = $candidateRecruitmentRepository;
    }

    public function removeApply(Request $request)
    {
        $id = CandidateRecruitment::where([['candidate_id', $request->all()['candidate_id']],['recruitment_id', $request->all()['recruitment_id']]])->get()->toArray()[0]['id'];
        try {
            $this->candidateRecruitmentRepository->delete($id);
            return $this->sendResult(true, "Delete Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Delete Failed", [], 400);
        }
    }
}
