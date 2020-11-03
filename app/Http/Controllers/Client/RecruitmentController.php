<?php

namespace App\Http\Controllers\Client;

use App\Models\Employer;
use App\Models\Recruitment;
use App\Repositories\Interfaces\RecruitmentRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Exception;


class RecruitmentController extends Controller
{
    private $recruitmentRepository;

    public function __construct(RecruitmentRepositoryInterface $recruitmentRepository)
    {
        $this->middleware(['auth:api', 'scope:employer'], [
            'except' => [
                'index',
                'show',
                'getRecruitmentsByEmployerId',
                'getRecruitmentOrder',
                'store',
                'update',
                'getRecruitmentEdit',
                'getRecruitmentAdmin',
                'changeActive',
                'changeOrder',
                'destroy',
                'dashboard',
                'getCvByUserId',
                'getCandidateByUserId'
            ],
        ]);
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

    public function getRecruitmentsByEmployerId($id, Request $request)
    {
        $data = $this->recruitmentRepository->getRecruitmentsByEmployerId($id)->get()->toArray();

        $datas = $this->recruitmentRepository->getRecruitmentsByEmployerId($id);

        if ($request->has('limit') && $request->has('page')) {
            $paginate = $request->only('limit', 'page');
            if (count($paginate) > 0) {
                $data = $datas->paginate($paginate['limit'])->toArray();
            }
        }

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

    public function getCandidateByUserId($id, Request $request)
    {
        $data = $this->recruitmentRepository->getCandidateByUserId($id)->get()->toArray();

        $datas = $this->recruitmentRepository->getCandidateByUserId($id);

        if ($request->has('name')) {
            if (is_null($request->get('name')) == false) {
                $data = $datas->where('candidates.name', 'LIKE', '%' . $request->get('name') . '%')->get()->toArray();
            } else {
                $data = $this->recruitmentRepository->getCandidateByUserId($id)->get()->toArray();
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

    public function getCvByUserId($id, Request $request)
    {
        $data = $this->recruitmentRepository->getCvByUserId($id)->get()->toArray();

        $datas = $this->recruitmentRepository->getCvByUserId($id);

        if ($request->has('name')) {
            if (is_null($request->get('name')) == false) {
                $data = $datas->where('candidates.name', 'LIKE', '%' . $request->get('name') . '%')->get()->toArray();
            } else {
                $data = $this->recruitmentRepository->getCvByUserId($id)->get()->toArray();
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

    public function saveImgBase64($param, $folder)
    {
        list($extension, $content) = explode(';', $param);
        $tmpExtension = explode('/', $extension);
        preg_match('/.([0-9]+) /', microtime(), $m);
        $fileName       = sprintf('img%s%s.%s', date('YmdHis'), $m[1], $tmpExtension[1]);
        $content        = explode(',', $content)[1];
        $storage        = Storage::disk('public');
        $checkDirectory = $storage->exists($folder);
        if (!$checkDirectory) {
            $storage->makeDirectory($folder);
        }
        $storage->put($folder . '/' . $fileName, base64_decode($content), 'public');
        return $fileName;
    }

    public function store(Request $request)
    {
        try {
            $data                = $request->except('user_id', 'photo', 'end_date');
            $date                = $request->all()['end_date'];
            $data['end_date']      = Carbon::parse($date)->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d');
            $employerId          = Employer::where('user_id', $request->only('user_id'))->get()->toArray();
            $data['employer_id'] = strval($employerId[0]['id']);
            $avatar              = $request->all()['photo'];
            $name_photo          = $this->saveImgBase64($avatar, 'uploads');
            $data['photo']       = 'http://103.200.20.171/storage/uploads/' . $name_photo;
            $result = $this->recruitmentRepository->create($data);
            return $this->sendResult(true, "Create Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Create Failed", [], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data           = $request->except('photo','end_date');
            $date                = $request->all()['end_date'];
            $data['end_date']      = Carbon::parse($date)->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d');
            $data['active'] = 0;
            $avatar         = $request->all()['photo'];
            $name_photo     = $this->saveImgBase64($avatar, 'uploads');
            $data['photo']  = 'http://103.200.20.171/storage/uploads/' . $name_photo;
            $result         = $this->recruitmentRepository->update($id, $data);
            return $this->sendResult(true, "Create Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Create Failed", [], 400);
        }
    }

    public function getRecruitmentEdit($id)
    {
        $data = $this->recruitmentRepository->getRecruitmentEdit($id)->get()->toArray();
        return $this->sendResult(true, 'Show Successfully', $data, 200);
    }

    public function getRecruitmentAdmin(Request $request)
    {
        $data  = $this->recruitmentRepository->getRecruitmentAdmin()->get()->toArray();
        $datas = $this->recruitmentRepository->getRecruitmentAdmin();
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
            $active = Recruitment::where('id', $id)->get()->toArray()[0]['active'];
            if ($active == 0) {
                $data['active'] = 1;
            } else {
                $data['active'] = 0;
            }
            $result = $this->recruitmentRepository->update($id, $data);
            return $this->sendResult(true, "Updated Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Updated Failed", [], 400);
        }
    }

    public function changeOrder($id)
    {
        try {
            $order = Recruitment::where('id', $id)->get()->toArray()[0]['order'];
            if ($order == 0) {
                $data['order'] = 1;
            } else {
                $data['order'] = 0;
            }
            $result = $this->recruitmentRepository->update($id, $data);
            return $this->sendResult(true, "Updated Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Updated Failed", [], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $this->recruitmentRepository->delete($id);
            return $this->sendResult(true, "Delete Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Delete Failed", [], 400);
        }
    }

    public function dashboard()
    {
        $data = $this->recruitmentRepository->dashboard();
        return $this->sendResult(true, 'Show Successfully', $data, 200);
    }
}
