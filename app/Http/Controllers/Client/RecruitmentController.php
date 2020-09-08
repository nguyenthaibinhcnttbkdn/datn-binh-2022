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
        $data = $this->recruitmentRepository->getRecruitmentOrder()->get()->toArray();
        return $this->sendResult(true, 'Show Successfully', $data, 200);
    }

    public function index(Request $request)
    {
        $data  = $this->recruitmentRepository->getRecruitment()->get()->toArray();
        $datas = $this->recruitmentRepository->getRecruitment();

        if ($request->has('vacancy')) {
            if (is_null($request->get('vacancy')) == false) {
                $data = $datas->where('recruitments.vacancy', 'LIKE', '%' . $request->get('vacancy') . '%')->get()->toArray();
            } else {
                $data = $this->recruitmentRepository->getRecruitment()->get()->toArray();
            }
        }

        if ($request->has('city')) {
            if (is_null($request->get('city')) == false) {
                $data = $datas->where('recruitments.city_id', '=', $request->get('city'))->get()->toArray();
            } else {
                $data = $this->recruitmentRepository->getRecruitment()->get()->toArray();
            }
        }

        if ($request->has('rank')) {
            if (is_null($request->get('rank')) == false) {
                $data = $datas->where('recruitments.rank_id', '=', $request->get('rank'))->get()->toArray();
            } else {
                $data = $this->recruitmentRepository->getRecruitment()->get()->toArray();
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
        $data = $this->recruitmentRepository->getRecruitmentById($id)->get()->toArray();
        return $this->sendResult(true, 'Show Successfully', $data, 200);
    }

    public function getRecruitmentsByEmployerId($id)
    {
        $data = $this->recruitmentRepository->getRecruitmentsByEmployerId($id)->get()->toArray();
        return $this->sendResult(true, 'Show Successfully', $data, 200);
    }

    public function getRecruitmentByUserId($id, Request $request)
    {
        $data = $this->recruitmentRepository->getRecruitmentByUserId($id)->get()->toArray();

        $datas = $this->recruitmentRepository->getRecruitmentByUserId($id);

        if ($request->has('vacancy')) {
            if (is_null($request->get('vacancy')) == false) {
                $data = $datas->where('recruitments.vacancy', 'LIKE', '%' . $request->get('vacancy') . '%')->get()->toArray();
            } else {
                $data = $this->recruitmentRepository->getRecruitmentByUserId($id)->get()->toArray();
            }
        }

        if ($request->has('active')) {
            if (is_null($request->get('active')) == false) {
                $data = $datas->where('recruitments.active', '=', $request->get('active'))->get()->toArray();
            } else {
                $data = $this->recruitmentRepository->getRecruitmentByUserId($id)->get()->toArray();
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
}
