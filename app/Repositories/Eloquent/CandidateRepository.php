<?php


namespace App\Repositories\Eloquent;

use App\Models\User;
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
            ->orderBy('candidates.order', 'asc');
        return $candidates;
    }

    public function getCandidate()
    {
        $candidates = DB::table('candidates')
            ->select()
            ->where('candidates.active', 1)
            ->orderBy('candidates.id', 'desc');;
        return $candidates;
    }

    public function addCandidate(array $data)
    {
        try {
            DB::beginTransaction();
            $userCreate = User::create([
                'email'    => $data['email'],
                'password' => bcrypt($data['password']),
                'role'     => $data['role'],
            ]);

            $candidateCreate = Candidate::create([
                'name'    => $data['name'],
                'phone'   => $data['phone'],
                'avatar'  => 'https://scontent-hkg4-1.xx.fbcdn.net/v/t1.0-9/117919076_318039892848770_6612572792333912945_n.jpg?_nc_cat=108&_nc_sid=8024bb&_nc_ohc=szo5eh0YxrAAX-8RevX&_nc_ht=scontent-hkg4-1.xx&oh=c6f8693b76c73889a3bdbf7cdb26496b&oe=5F696FA4',
                'user_id' => $userCreate->id,
            ]);

            DB::commit();
            return true;
        } catch (Exception $ex) {
            DB::rollback();
            return false;
        }
    }

    public function getCandidateByUserId($id)
    {
        $candidate = Candidate::where('user_id', $id)->get();
        return $candidate;
    }
}
