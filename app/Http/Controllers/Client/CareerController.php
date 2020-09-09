<?php

namespace App\Http\Controllers\Client;

use App\Repositories\Interfaces\CareerRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
