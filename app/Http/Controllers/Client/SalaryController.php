<?php

namespace App\Http\Controllers\Client;

use App\Repositories\Interfaces\SalaryRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
