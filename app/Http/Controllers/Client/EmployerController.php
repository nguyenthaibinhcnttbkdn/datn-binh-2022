<?php

namespace App\Http\Controllers\Client;

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
}
