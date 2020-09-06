<?php

namespace App\Http\Controllers\Client;

use App\Repositories\Interfaces\EmployerRepositoryInterface;
use App\Http\Controllers\Controller;

class EmployerController extends Controller
{
    private $employerRepository;

    public function __construct(EmployerRepositoryInterface $employerRepository)
    {
        $this->employerRepository = $employerRepository;
    }

    public function getEmployerOrder()
    {
        $data   = $this->employerRepository->getEmployerOrder()->get()->toArray();
        return $this->sendResult(true, 'Show Successfully', $data, 200);
    }
}
