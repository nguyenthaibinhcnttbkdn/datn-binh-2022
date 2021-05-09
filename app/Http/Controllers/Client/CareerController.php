<?php

namespace App\Http\Controllers\Client;

use App\Repositories\Interfaces\CareerRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;


class CareerController extends Controller
{
    private $careerRepository;

    public function __construct(CareerRepositoryInterface $careerRepository)
    {
        $this->careerRepository = $careerRepository;
    }

    public function index()
    {
        $data = $this->careerRepository->getAll()->toArray();
        return $this->sendResult(true, 'Show Successfully', $data, 200);
    }

    public function store(Request $request)
    {
        try {
            $data   = $request->only('name');
            $result = $this->careerRepository->create($data);
            return $this->sendResult(true, "Create Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Create Failed", [], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data   = $request->only('name');
            $result = $this->careerRepository->update($id, $data);
            return $this->sendResult(true, "Create Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Create Failed", [], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $result = $this->careerRepository->delete($id);
            return $this->sendResult(true, "Create Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Create Failed", [], 400);
        }
    }
}
