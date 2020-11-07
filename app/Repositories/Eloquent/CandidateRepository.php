<?php


namespace App\Repositories\Eloquent;

use App\Models\Curriculumvitae;
use App\Models\Employer;
use App\Models\Recruitment;
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
            ->where('candidates.order', 1)
            ->orderBy('candidates.id', 'asc');
        return $candidates;
    }

    public function getCandidate()
    {
        $candidates = DB::table('candidates')
            ->select()
            ->where('candidates.active', 1)
            ->orderBy('candidates.id', 'desc');
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
                'avatar'  => 'https://lh3.googleusercontent.com/pw/ACtC-3d6S8OCbG8Ez42boNCkDpAmzXiCFQUYi7nJk0oV0B97zzFFIkmH4pWDbjrtZH9myZXNu_FZzfQuj93a3FuF2nKTL_zR47RRKP12x8krEgDyTSI5bhHGDo75R9kYbOHiM4hZaXZESIrIU6Q17YDB99l9=w225-h224-no',
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
        $candidate = DB::table('candidates')
            ->leftJoin('users', 'users.id', '=', 'candidates.user_id')
            ->select('candidates.id',
                'candidates.name',
                'candidates.avatar',
                'candidates.phone',
                'candidates.position',
                'candidates.address',
                'candidates.experience',
                'candidates.birthday',
                'users.email as email',
                'candidates.user_id',
                'candidates.active',
                'candidates.order',
                'candidates.created_at',
                'candidates.updated_at'
            )
            ->where('candidates.user_id', $id)->get();
        return $candidate;
    }

    public function getRecruitmentByUserId($id)
    {
        $candidateId = Candidate::where('user_id', $id)->get()->toArray()[0]['id'];

        $recruiments = Recruitment::with(['rank', 'type_of_work', 'city', 'career', 'employer', 'salary'])
            ->whereHas('candidates', function ($query) use ($candidateId) {
                $query->where('candidate_id', $candidateId);
            });

        return ($recruiments);
    }

    public function getCandidateAdmin()
    {
        $candidates = DB::table('candidates')
            ->select()
            ->orderBy('candidates.id', 'desc');
        return $candidates;
    }

    public function getJobApplyByUserId($id)
    {
        $candidateId = Candidate::where('user_id', $id)->get()->toArray()[0]['id'];

        $candidate = DB::table('candidates')
            ->leftJoin('curriculumvitaes', 'candidates.id', '=', 'curriculumvitaes.candidate_id')
            ->leftJoin('cvrecruitments', 'cvrecruitments.cv_id', '=', 'curriculumvitaes.id')
            ->leftJoin('recruitments', 'recruitments.id', '=', 'cvrecruitments.recruitment_id')
            ->select(
                'cvrecruitments.id as ids',
                'recruitments.id',
                'recruitments.vacancy',
                'recruitments.quantity',
                'recruitments.end_date',
                'recruitments.photo',
                'recruitments.description',
                'recruitments.entitlements',
                'recruitments.job_requirements',
                'recruitments.requested_documents'
            )
            ->where('candidates.id', $candidateId);
        return $candidate;
    }

    public function dashboardCandidate($id)
    {
        $candidateId = Candidate::where('user_id', $id)->get()->toArray()[0]['id'];

        $job = DB::table('candidates')
            ->leftJoin('curriculumvitaes', 'candidates.id', '=', 'curriculumvitaes.candidate_id')
            ->leftJoin('cvrecruitments', 'cvrecruitments.cv_id', '=', 'curriculumvitaes.id')
            ->leftJoin('recruitments', 'recruitments.id', '=', 'cvrecruitments.recruitment_id')
            ->select(
                'cvrecruitments.id as ids',
                'recruitments.id',
                'recruitments.vacancy',
                'recruitments.quantity',
                'recruitments.end_date',
                'recruitments.photo',
                'recruitments.description',
                'recruitments.entitlements',
                'recruitments.job_requirements',
                'recruitments.requested_documents'
            )
            ->where('candidates.id', $candidateId)
            ->get();

        $cv = Curriculumvitae::where('candidate_id', $candidateId)->get();

        $data['job'] = count($job);
        $data['cv']  = count($cv);

        return $data;
    }
}
