<?php

namespace App\Http\Controllers\Client;

use App\Repositories\Interfaces\RankRepositoryInterface;
use App\Http\Controllers\Controller;

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
}
