<?php

namespace App\Http\Controllers\Client;

use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    private $cityRepository;

    public function __construct(CityRepositoryInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function index()
    {
        $data = $this->cityRepository->getAll()->toArray();
        return $this->sendResult(true, 'Show Successfully', $data, 200);
    }
}
