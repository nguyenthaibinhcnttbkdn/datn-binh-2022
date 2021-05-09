<?php

namespace App\Http\Controllers\Client;

use App\Repositories\Interfaces\SalaryRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class SalaryController extends Controller
{
    private $salaryRepository;

    public function __construct(SalaryRepositoryInterface $salaryRepository)
    {
        $this->salaryRepository = $salaryRepository;
    }

    public function index()
    {
        $data = $this->salaryRepository->getAll()->toArray();
        return $this->sendResult(true, 'Show Successfully', $data, 200);
    }

    public function store(Request $request)
    {
        try {
            $data   = $request->only('name');
            $result = $this->salaryRepository->create($data);
            return $this->sendResult(true, "Create Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Create Failed", [], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data   = $request->only('name');
            $result = $this->salaryRepository->update($id, $data);
            return $this->sendResult(true, "Create Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Create Failed", [], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $result = $this->salaryRepository->delete($id);
            return $this->sendResult(true, "Create Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Create Failed", [], 400);
        }
    }
}
