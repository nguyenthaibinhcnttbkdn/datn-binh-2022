<?php

namespace App\Http\Controllers\Client;

use App\Repositories\Interfaces\CandidateRepositoryInterface;
use App\Http\Controllers\Controller;

class CandidateController extends Controller
{
    private $candidateRepository;

    public function __construct(CandidateRepositoryInterface $candidateRepository)
    {
        $this->candidateRepository = $candidateRepository;
    }

    public function getCandidateOrder()
    {
        $data   = $this->candidateRepository->getCandidateOrder()->get()->toArray();
        return $this->sendResult(true, 'Show Successfully', $data, 200);
    }
}
