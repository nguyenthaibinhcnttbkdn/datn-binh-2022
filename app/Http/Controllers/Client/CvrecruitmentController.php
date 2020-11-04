<?php

namespace App\Http\Controllers\Client;

use App\Repositories\Interfaces\CvrecruitmentRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class CvrecruitmentController extends Controller
{
    private $cvRecruitmentRepository;

    public function __construct(CvrecruitmentRepositoryInterface $cvRecruitmentRepository)
    {
        $this->cvRecruitmentRepository = $cvRecruitmentRepository;
    }

    public function store(Request $request)
    {
        try {
            $result = $this->cvRecruitmentRepository->create($request->all());
            return $this->sendResult(true, "Create Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Create Failed", [], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $this->cvRecruitmentRepository->delete($id);
            return $this->sendResult(true, "Delete Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Delete Failed", [], 400);
        }
    }
}
