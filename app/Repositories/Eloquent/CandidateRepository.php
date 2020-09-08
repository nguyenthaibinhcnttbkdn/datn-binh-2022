<?php


namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\CandidateRepositoryInterface;
use App\Models\Candidate;
use Illuminate\Support\Facades\DB;

class CandidateRepository extends BaseRepository implements CandidateRepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Candidate::class;
    }

    public function getCandidateOrder()
    {
        $candidates = DB::table('candidates')
            ->select()
            ->where('candidates.order', '<>', null)
            ->orderBy('candidates.order', 'asc');;
        return $candidates;
    }

    public function getCandidate()
    {
        $candidates = DB::table('candidates')
            ->select()
            ->orderBy('candidates.id', 'desc');;
        return $candidates;
    }
}
