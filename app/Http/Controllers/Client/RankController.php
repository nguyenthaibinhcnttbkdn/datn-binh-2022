<?php

namespace App\Http\Controllers\Client;

use App\Repositories\Interfaces\RankRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class RankController extends Controller
{
    private $rankRepository;

    public function __construct(RankRepositoryInterface $rankRepository)
    {
        $this->rankRepository = $rankRepository;
    }

    public function index()
    {
        $data = $this->rankRepository->getAll()->toArray();
        return $this->sendResult(true, 'Show Successfully', $data, 200);
    }

    public function store(Request $request)
    {
        try {
            $data   = $request->only('name');
            $result = $this->rankRepository->create($data);
            return $this->sendResult(true, "Create Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Create Failed", [], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data   = $request->only('name');
            $result = $this->rankRepository->update($id, $data);
            return $this->sendResult(true, "Create Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Create Failed", [], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $result = $this->rankRepository->delete($id);
            return $this->sendResult(true, "Create Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Create Failed", [], 400);
        }
    }
}
