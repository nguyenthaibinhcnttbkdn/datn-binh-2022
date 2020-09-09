<?php

namespace App\Http\Controllers\Client;

use App\Repositories\Interfaces\TypeOfWorkRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
