<?php

namespace App\Http\Controllers\Client;

use App\Repositories\Interfaces\TypeOfWorkRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class TypeOfWorkController extends Controller
{
    private $typeOfWorkRepository;

    public function __construct(TypeOfWorkRepositoryInterface $typeOfWorkRepository)
    {
        $this->typeOfWorkRepository = $typeOfWorkRepository;
    }

    public function index()
    {
        $data = $this->typeOfWorkRepository->getAll()->toArray();
        return $this->sendResult(true, 'Show Successfully', $data, 200);
    }

    public function store(Request $request)
    {
        try {
            $data   = $request->only('name');
            $result = $this->typeOfWorkRepository->create($data);
            return $this->sendResult(true, "Create Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Create Failed", [], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data   = $request->only('name');
            $result = $this->typeOfWorkRepository->update($id, $data);
            return $this->sendResult(true, "Create Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Create Failed", [], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $result = $this->typeOfWorkRepository->delete($id);
            return $this->sendResult(true, "Create Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Create Failed", [], 400);
        }
    }
}
