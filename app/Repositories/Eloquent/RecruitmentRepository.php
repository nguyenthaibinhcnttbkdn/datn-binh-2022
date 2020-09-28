<?php


namespace App\Repositories\Eloquent;

use App\Models\Candidate;
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
            ->where('recruitments.order', '<>', null)
            ->orderBy('recruitments.order', 'asc');;

        return $recruitments;
    }

    public function getRecruitment()
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
            ->where('recruitments.active', 1)
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
                'employers.avatar as avatar'
            )
            ->where('recruitments.id', $id);

        return $recruitments;
    }

    public function getRecruitmentsByEmployerId($id)
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
            ->where('recruitments.active', 1)
            ->where('employers.id', $id)
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
            ->where('employers.id', $imployerId[0]['id'])
            ->orderBy('recruitments.id', 'desc');
        return $recruitments;
    }

    public function getCandidateByUserId($id)
    {
        $jobs= Recruitment::select('id')
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
}
