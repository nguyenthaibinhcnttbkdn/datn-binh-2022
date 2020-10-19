<?php

namespace App\Http\Controllers\Client;

use App\Models\Employer;
use App\Models\User;
use App\Repositories\Interfaces\EmployerRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class EmployerController extends Controller
{
    private $employerRepository;

    public function __construct(EmployerRepositoryInterface $employerRepository)
    {
        $this->middleware(['auth:api', 'scope:employer'], ['except' => ['index', 'show', 'addEmployer', 'getEmployerOrder', 'update', 'getEmployerByUserId', 'getEmployerAdmin', 'changeActive','changeOrder','dashboardEmployer']]);
        $this->employerRepository = $employerRepository;
    }

    public function getEmployerOrder()
    {
        $data = $this->employerRepository->getEmployerOrder()->get()->toArray();
        return $this->sendResult(true, 'Show Successfully', $data, 200);
    }

    public function index(Request $request)
    {
        $data = $this->employerRepository->getEmployer()->get()->toArray();

        $datas = $this->employerRepository->getEmployer();

        if ($request->has('company')) {
            if (is_null($request->get('company')) == false) {
                $data = $datas->where('employers.company', 'LIKE', '%' . $request->get('company') . '%')->get()->toArray();
            } else {
                $data = $this->employerRepository->getEmployer()->get()->toArray();
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
        $data = $this->employerRepository->find($id)->toArray();
        return $this->sendResult(true, 'Show Successfully', [$data], 200);
    }

    public function addEmployer(Request $request)
    {
        $user_exist = User::where('email', $request->get('email'))->get()->toArray();
        if (count($user_exist) > 0) {
            return $this->sendError(false, "Tài khoản đã tồn tại !", [], 403);
        }

        $data         = $request->all();
        $data['role'] = 2;

        try {
            $data = $this->employerRepository->addEmployer($data);
            return $this->sendResult(true, 'Insert Successfully', [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Insert Failed", [], 401);
        }
    }

    public function getEmployerByUserId($id)
    {
        $data = $this->employerRepository->getEmployerByUserId($id)->toArray();
        return $this->sendResult(true, 'Show Successfully', $data, 200);
    }

    public function getCandidateSaveByUserId($id, Request $request)
    {
        $data = $this->employerRepository->getCandidateSaveByUserId($id)->get()->toArray();

        $datas = $this->employerRepository->getCandidateSaveByUserId($id);

        if ($request->has('name')) {
            if (is_null($request->get('name')) == false) {
                $data = $datas->where('candidates.name', 'LIKE', '%' . $request->get('name') . '%')->get()->toArray();
            } else {
                $data = $this->employerRepository->getCandidateSaveByUserId($id)->get()->toArray();
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

    public function update(Request $request, $id)
    {
        try {
            $avatar      = $request->all()['avatar'];
            $name_avatar = $this->saveImgBase64($avatar, 'uploads');

            $photo      = $request->all()['photo'];
            $name_photo = $this->saveImgBase64($photo, 'uploads');

            $data['contact']     = $request->all()['contact'];
            $data['company']     = $request->all()['company'];
            $data['phone']       = $request->all()['phone'];
            $data['address']     = $request->all()['address'];
            $data['website']     = $request->all()['website'];
            $data['description'] = $request->all()['description'];
            $data['avatar']      = 'http://103.200.20.171/storage/uploads/' . $name_avatar;
            $data['photo']       = 'http://103.200.20.171/storage/uploads/' . $name_photo;

            $result = $this->employerRepository->update($id, $data);

            return $this->sendResult(true, "Updated Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Updated Failed", [], 400);
        }
    }

    public function getEmployerAdmin(Request $request)
    {
        $data = $this->employerRepository->getEmployerAdmin()->get()->toArray();
        $datas = $this->employerRepository->getEmployerAdmin();
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
            $active = Employer::where('id', $id)->get()->toArray()[0]['active'];
            if ($active == 0) {
                $data['active'] = 1;
            } else {
                $data['active'] = 0;
            }
            $result = $this->employerRepository->update($id, $data);
            return $this->sendResult(true, "Updated Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Updated Failed", [], 400);
        }
    }

    public function changeOrder($id)
    {
        try {
            $order = Employer::where('id', $id)->get()->toArray()[0]['order'];
            if ($order == 0) {
                $data['order'] = 1;
            } else {
                $data['order'] = 0;
            }
            $result = $this->employerRepository->update($id, $data);
            return $this->sendResult(true, "Updated Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Updated Failed", [], 400);
        }
    }

    public function dashboardEmployer($id){
        $data = $this->employerRepository->dashboardEmployer($id);
        return $this->sendResult(true, 'Show Successfully', $data, 200);
    }
}
