<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use App\Models\Candidate;
use App\Repositories\Interfaces\CandidateRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class CandidateController extends Controller
{
    private $candidateRepository;

    public function __construct(CandidateRepositoryInterface $candidateRepository)
    {
        $this->middleware(['auth:api', 'scope:candidate'], ['except' => ['index', 'show', 'addCandidate', 'getCandidateOrder','getCandidateAdmin']]);
        $this->candidateRepository = $candidateRepository;
    }

    public function getCandidateOrder()
    {
        $data = $this->candidateRepository->getCandidateOrder()->get()->toArray();
        return $this->sendResult(true, 'Show Successfully', $data, 200);
    }

    public function index(Request $request)
    {
        $data = $this->candidateRepository->getCandidate()->get()->toArray();

        $datas = $this->candidateRepository->getCandidate();

        if ($request->has('name')) {
            if (is_null($request->get('name')) == false) {
                $data = $datas->where('candidates.name', 'LIKE', '%' . $request->get('name') . '%')->get()->toArray();
            } else {
                $data = $this->candidateRepository->getCandidate()->get()->toArray();
            }
        }

        if ($request->has('limit') && $request->has('page')) {
            $paginate = $request->only('limit', 'page');
            if (count($paginate) > 0) {
                $data = $datas->paginate($paginate['limit'])->toArray();
            }
        }

        return $this->sendResult(true, 'Show Successfully', $data, 200);
    }

    public function show($id)
    {
        $data = $this->candidateRepository->find($id)->toArray();
        return $this->sendResult(true, 'Show Successfully', [$data], 200);
    }

    public function addCandidate(Request $request)
    {
        $user_exist = User::where('email', $request->get('email'))->get()->toArray();
        if (count($user_exist) > 0) {
            return $this->sendError(false, "Tài khoản đã tồn tại !", [], 401);
        }

        $data         = $request->all();
        $data['role'] = 3;

        try {
            $data = $this->candidateRepository->addCandidate($data);
            return $this->sendResult(true, 'Insert Successfully', [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Insert Failed", [], 401);
        }
    }

    public function getCandidateByUserId($id)
    {
        $data = $this->candidateRepository->getCandidateByUserId($id)->toArray();
        return $this->sendResult(true, 'Show Successfully', $data, 200);
    }

    public function getRecruitmentByUserId($id)
    {
        $data = $this->candidateRepository->getRecruitmentByUserId($id)->get()->toArray();
        return $this->sendResult(true, 'Show Successfully', $data, 200);
    }

    public function getCandidateAdmin(Request $request)
    {
        $data = $this->candidateRepository->getCandidateAdmin()->get()->toArray();
        $datas = $this->candidateRepository->getCandidateAdmin();
        if ($request->has('limit') && $request->has('page')) {
            $paginate = $request->only('limit', 'page');
            if (count($paginate) > 0) {
                $data = $datas->paginate($paginate['limit'])->toArray();
            }
        }
        return $this->sendResult(true, 'Show Successfully', $data, 200);
    }

    public function changeActive($id)
    {
        try {
            $active = Candidate::where('id', $id)->get()->toArray()[0]['active'];
            if ($active == 0) {
                $data['active'] = 1;
            } else {
                $data['active'] = 0;
            }
            $result = $this->candidateRepository->update($id, $data);
            return $this->sendResult(true, "Updated Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Updated Failed", [], 400);
        }
    }

}
