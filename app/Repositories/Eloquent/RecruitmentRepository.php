<?php


namespace App\Repositories\Eloquent;

use App\Models\Candidate;
use App\Models\Curriculumvitae;
use App\Models\Employer;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\RecruitmentRepositoryInterface;
use App\Models\Recruitment;
use Illuminate\Support\Facades\DB;


class RecruitmentRepository extends BaseRepository implements RecruitmentRepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Recruitment::class;
    }

    public function getRecruitmentOrder()
    {
        $nows         = date(now()->toDateString());
        $recruitments = DB::table('recruitments')
            ->leftJoin('ranks', 'recruitments.rank_id', '=', 'ranks.id')
            ->leftJoin('type_of_works', 'recruitments.type_of_work_id', '=', 'type_of_works.id')
            ->leftJoin('cities', 'recruitments.city_id', '=', 'cities.id')
            ->leftJoin('careers', 'recruitments.career_id', '=', 'careers.id')
            ->leftJoin('salaries', 'recruitments.salary_id', '=', 'salaries.id')
            ->leftJoin('employers', 'recruitments.employer_id', '=', 'employers.id')
            ->select('recruitments.id',
                'recruitments.vacancy',
                'recruitments.quantity',
                'recruitments.end_date',
                'recruitments.photo',
                'recruitments.description',
                'recruitments.entitlements',
                'recruitments.job_requirements',
                'recruitments.requested_documents',
                'recruitments.active',
                'recruitments.order',
                'ranks.name as rank',
                'type_of_works.name as type_of_work',
                'cities.name as city',
                'careers.name as career',
                'salaries.name as salary',
                'employers.company as company',
                'employers.avatar as avatar'
            )
            ->where('recruitments.order', 1)
            ->where('recruitments.end_date', '>', $nows)
            ->orderBy('recruitments.id', 'asc');;

        return $recruitments;
    }

    public function getRecruitment()
    {
        $nows         = date(now()->toDateString());
        $recruitments = DB::table('recruitments')
            ->leftJoin('ranks', 'recruitments.rank_id', '=', 'ranks.id')
            ->leftJoin('type_of_works', 'recruitments.type_of_work_id', '=', 'type_of_works.id')
            ->leftJoin('cities', 'recruitments.city_id', '=', 'cities.id')
            ->leftJoin('careers', 'recruitments.career_id', '=', 'careers.id')
            ->leftJoin('salaries', 'recruitments.salary_id', '=', 'salaries.id')
            ->leftJoin('employers', 'recruitments.employer_id', '=', 'employers.id')
            ->select('recruitments.id',
                'recruitments.vacancy',
                'recruitments.quantity',
                'recruitments.end_date',
                'recruitments.photo',
                'recruitments.description',
                'recruitments.entitlements',
                'recruitments.job_requirements',
                'recruitments.requested_documents',
                'recruitments.active',
                'recruitments.order',
                'ranks.name as rank',
                'type_of_works.name as type_of_work',
                'cities.name as city',
                'careers.name as career',
                'salaries.name as salary',
                'employers.company as company',
                'employers.avatar as avatar'
            )
            ->where('recruitments.deleted_at', null)
            ->where('recruitments.active', 1)
            ->where('recruitments.end_date', '>', $nows)
            ->orderBy('recruitments.id', 'desc');

        return $recruitments;
    }

    public function getRecruitmentById($id)
    {
        $recruitments = DB::table('recruitments')
            ->leftJoin('ranks', 'recruitments.rank_id', '=', 'ranks.id')
            ->leftJoin('type_of_works', 'recruitments.type_of_work_id', '=', 'type_of_works.id')
            ->leftJoin('cities', 'recruitments.city_id', '=', 'cities.id')
            ->leftJoin('careers', 'recruitments.career_id', '=', 'careers.id')
            ->leftJoin('salaries', 'recruitments.salary_id', '=', 'salaries.id')
            ->leftJoin('employers', 'recruitments.employer_id', '=', 'employers.id')
            ->select('recruitments.id',
                'recruitments.vacancy',
                'recruitments.quantity',
                'recruitments.end_date',
                'recruitments.photo',
                'recruitments.description',
                'recruitments.entitlements',
                'recruitments.job_requirements',
                'recruitments.requested_documents',
                'recruitments.active',
                'recruitments.order',
                'ranks.name as rank',
                'type_of_works.name as type_of_work',
                'cities.name as city',
                'careers.name as career',
                'salaries.name as salary',
                'employers.company as company',
                'employers.avatar as avatar',
                'employers.phone as phone',
                'employers.address as address',
                'employers.website as website',
                'employers.description as description',
                'employers.contact as contact'
            )
            ->where('recruitments.id', $id);

        return $recruitments;
    }

    public function getRecruitmentsByEmployerId($id)
    {
        $nows         = date(now()->toDateString());
        $recruitments = DB::table('recruitments')
            ->leftJoin('ranks', 'recruitments.rank_id', '=', 'ranks.id')
            ->leftJoin('type_of_works', 'recruitments.type_of_work_id', '=', 'type_of_works.id')
            ->leftJoin('cities', 'recruitments.city_id', '=', 'cities.id')
            ->leftJoin('careers', 'recruitments.career_id', '=', 'careers.id')
            ->leftJoin('salaries', 'recruitments.salary_id', '=', 'salaries.id')
            ->leftJoin('employers', 'recruitments.employer_id', '=', 'employers.id')
            ->select('recruitments.id',
                'recruitments.vacancy',
                'recruitments.quantity',
                'recruitments.end_date',
                'recruitments.photo',
                'recruitments.description',
                'recruitments.entitlements',
                'recruitments.job_requirements',
                'recruitments.requested_documents',
                'recruitments.active',
                'recruitments.order',
                'ranks.name as rank',
                'type_of_works.name as type_of_work',
                'cities.name as city',
                'careers.name as career',
                'salaries.name as salary',
                'employers.company as company',
                'employers.avatar as avatar'
            )
            ->where('recruitments.deleted_at', null)
            ->where('recruitments.active', 1)
            ->where('employers.id', $id)
            ->where('recruitments.end_date', '>', $nows)
            ->orderBy('recruitments.id', 'desc');
        return $recruitments;
    }

    public function getRecruitmentByUserId($id)
    {
        $imployerId   = Employer::where('user_id', $id)->get()->toArray();
        $recruitments = DB::table('recruitments')
            ->leftJoin('ranks', 'recruitments.rank_id', '=', 'ranks.id')
            ->leftJoin('type_of_works', 'recruitments.type_of_work_id', '=', 'type_of_works.id')
            ->leftJoin('cities', 'recruitments.city_id', '=', 'cities.id')
            ->leftJoin('careers', 'recruitments.career_id', '=', 'careers.id')
            ->leftJoin('salaries', 'recruitments.salary_id', '=', 'salaries.id')
            ->leftJoin('employers', 'recruitments.employer_id', '=', 'employers.id')
            ->select('recruitments.id',
                'recruitments.vacancy',
                'recruitments.quantity',
                'recruitments.end_date',
                'recruitments.photo',
                'recruitments.description',
                'recruitments.entitlements',
                'recruitments.job_requirements',
                'recruitments.requested_documents',
                'recruitments.active',
                'recruitments.order',
                'ranks.name as rank',
                'type_of_works.name as type_of_work',
                'cities.name as city',
                'careers.name as career',
                'salaries.name as salary',
                'employers.company as company',
                'employers.avatar as avatar'
            )
            ->where('recruitments.deleted_at', null)
            ->where('employers.id', $imployerId[0]['id'])
            ->orderBy('recruitments.id', 'desc');
        return $recruitments;
    }

    public function getCandidateByUserId($id)
    {
        $jobs = Recruitment::select('id')
            ->whereHas('employer', function ($query) use ($id) {
                $query->where('user_id', $id);
            })->get();

        $recruimentIds = [];
        foreach ($jobs as $key => $job) {
            array_push($recruimentIds, $job->id);
        }

        $candidates = Candidate::with('user')
            ->whereHas('recruitments', function ($query) use ($recruimentIds) {
                $query->whereIn('recruitment_id', $recruimentIds);
            });
        return $candidates;
    }

    public function getRecruitmentEdit($id)
    {
        $recruitments = DB::table('recruitments')
            ->leftJoin('ranks', 'recruitments.rank_id', '=', 'ranks.id')
            ->leftJoin('type_of_works', 'recruitments.type_of_work_id', '=', 'type_of_works.id')
            ->leftJoin('cities', 'recruitments.city_id', '=', 'cities.id')
            ->leftJoin('careers', 'recruitments.career_id', '=', 'careers.id')
            ->leftJoin('salaries', 'recruitments.salary_id', '=', 'salaries.id')
            ->leftJoin('employers', 'recruitments.employer_id', '=', 'employers.id')
            ->select('recruitments.id',
                'recruitments.vacancy',
                'recruitments.quantity',
                'recruitments.end_date',
                'recruitments.photo',
                'recruitments.description',
                'recruitments.entitlements',
                'recruitments.job_requirements',
                'recruitments.requested_documents',
                'recruitments.active',
                'recruitments.order',
                'ranks.id as rank_id',
                'type_of_works.id as type_of_work_id',
                'cities.id as city_id',
                'careers.id as career_id',
                'salaries.id as salary_id',
                'employers.company as company',
                'employers.avatar as avatar'
            )
            ->where('recruitments.id', $id);

        return $recruitments;
    }

    public function getRecruitmentAdmin()
    {
        $recruitments = DB::table('recruitments')
            ->leftJoin('ranks', 'recruitments.rank_id', '=', 'ranks.id')
            ->leftJoin('type_of_works', 'recruitments.type_of_work_id', '=', 'type_of_works.id')
            ->leftJoin('cities', 'recruitments.city_id', '=', 'cities.id')
            ->leftJoin('careers', 'recruitments.career_id', '=', 'careers.id')
            ->leftJoin('salaries', 'recruitments.salary_id', '=', 'salaries.id')
            ->leftJoin('employers', 'recruitments.employer_id', '=', 'employers.id')
            ->select('recruitments.id',
                'recruitments.vacancy',
                'recruitments.quantity',
                'recruitments.end_date',
                'recruitments.photo',
                'recruitments.description',
                'recruitments.entitlements',
                'recruitments.job_requirements',
                'recruitments.requested_documents',
                'recruitments.active',
                'recruitments.order',
                'ranks.name as rank',
                'type_of_works.name as type_of_work',
                'cities.name as city',
                'careers.name as career',
                'salaries.name as salary',
                'employers.company as company',
                'employers.avatar as avatar'
            )
            ->where('recruitments.deleted_at', null)
            ->orderBy('recruitments.id', 'desc');

        return $recruitments;
    }

    public function dashboard()
    {
        $recruitments = DB::table('recruitments')->where('recruitments.active', 1)->where('recruitments.deleted_at', null)->get();
        $employers    = DB::table('employers')->where('employers.active', 1)->get();
        $candidates   = DB::table('candidates')->where('candidates.active', 1)->get();

        $data['recruitments'] = count($recruitments);
        $data['employers']    = count($employers);
        $data['candidates']   = count($candidates);

        return $data;
    }

    public function getCvByUserId($id)
    {
        $jobs = Recruitment::select('id')
            ->whereHas('employer', function ($query) use ($id) {
                $query->where('user_id', $id);
            })->get();

        $recruimentIds = [];
        foreach ($jobs as $key => $job) {
            array_push($recruimentIds, $job->id);
        }

        $cvs = DB::table('cvrecruitments')
            ->leftJoin('recruitments', 'recruitments.id', '=', 'cvrecruitments.recruitment_id')
            ->leftJoin('curriculumvitaes', 'curriculumvitaes.id', '=', 'cvrecruitments.cv_id')
            ->leftJoin('candidates', 'candidates.id', '=', 'curriculumvitaes.candidate_id')
            ->select(
                'cvrecruitments.id',
                'cvrecruitments.cv_id',
                'candidates.id as candidate_id',
                'candidates.name',
                'candidates.avatar',
                'candidates.phone',
                'candidates.position',
                'candidates.address',
                'candidates.experience',
                'candidates.birthday',
                'candidates.user_id',
                'recruitments.vacancy'
            )
            ->whereIn('cvrecruitments.recruitment_id', $recruimentIds);
        return $cvs;
    }

    public function dashboardAdmin()
    {
        $recruitments = DB::table('recruitments')->where('recruitments.active', 1)->where('recruitments.deleted_at', null)->get();
        $employers    = DB::table('employers')->where('employers.active', 1)->get();
        $candidates   = DB::table('candidates')->where('candidates.active', 1)->get();

        $recruitments_no_active = DB::table('recruitments')->where('recruitments.active', 0)->where('recruitments.deleted_at', null)->get();
        $employers_no_active    = DB::table('employers')->where('employers.active', 0)->get();
        $candidates_no_active   = DB::table('candidates')->where('candidates.active', 0)->get();

        $data['recruitments'] = count($recruitments);
        $data['employers']    = count($employers);
        $data['candidates']   = count($candidates);

        $data['recruitments_no_active'] = count($recruitments_no_active);
        $data['employers_no_active']    = count($employers_no_active);
        $data['candidates_no_active']   = count($candidates_no_active);

        return $data;
    }

    public function deleteRecruitment($id)
    {
        try {
            DB::beginTransaction();
            //code ở đây nè
            DB::commit();
            return true;
        } catch (Exception $ex) {
            DB::rollback();
            return false;
        }
    }
}
