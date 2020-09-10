<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use App\Repositories\Interfaces\EmployerRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    private $employerRepository;

    public function __construct(EmployerRepositoryInterface $employerRepository)
    {
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
            return $this->sendError(false, "Tài khoản đã tồn tại !", [], 401);
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
}
