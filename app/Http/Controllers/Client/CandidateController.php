<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use App\Models\Candidate;
use App\Repositories\Interfaces\CandidateRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    private $candidateRepository;

    public function __construct(CandidateRepositoryInterface $candidateRepository)
    {
        $this->middleware(['auth:api', 'scope:candidate'], ['except' => ['index', 'show', 'addCandidate', 'getCandidateOrder', 'getCandidateAdmin', 'changeActive', 'changeOrder','getRecruitmentByUserId']]);
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

    public function getRecruitmentByUserId(Request $request,$id)
    {
        $data = $this->candidateRepository->getRecruitmentByUserId($id)->get()->toArray();

        $datas = $this->candidateRepository->getRecruitmentByUserId($id);

        if ($request->has('vacancy')) {
            if (is_null($request->get('vacancy')) == false) {
                $data = $datas->where('recruitments.vacancy', 'LIKE', '%' . $request->get('vacancy') . '%')->get()->toArray();
            } else {
                $data = $this->candidateRepository->getRecruitmentByUserId($id)->get()->toArray();
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

    public function getCandidateAdmin(Request $request)
    {
        $data  = $this->candidateRepository->getCandidateAdmin()->get()->toArray();
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

    public function changeOrder($id)
    {
        try {
            $order = Candidate::where('id', $id)->get()->toArray()[0]['order'];
            if ($order == 0) {
                $data['order'] = 1;
            } else {
                $data['order'] = 0;
            }
            $result = $this->candidateRepository->update($id, $data);
            return $this->sendResult(true, "Updated Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Updated Failed", [], 400);
        }
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

    public function update(Request $request, $id)
    {
        try {
            $avatar      = $request->all()['avatar'];
            $name_avatar = $this->saveImgBase64($avatar, 'uploads');

            $data['name']       = $request->all()['name'];
            $data['phone']      = $request->all()['phone'];
            $data['position']   = $request->all()['position'];
            $data['address']    = $request->all()['address'];
            $data['experience'] = $request->all()['experience'];
            $data['avatar']     = 'http://103.200.20.171/storage/uploads/' . $name_avatar;

            $result = $this->candidateRepository->update($id, $data);

            return $this->sendResult(true, "Updated Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Updated Failed", [], 400);
        }
    }
}
