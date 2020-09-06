<?php


namespace App\Repositories\Eloquent;

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
}
