<?php


namespace App\Repositories\Eloquent;

use App\Models\Candidate;
use App\Models\Recruitment;
use App\Models\User;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\EmployerRepositoryInterface;
use App\Models\Employer;
use Illuminate\Support\Facades\DB;

class EmployerRepository extends BaseRepository implements EmployerRepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Employer::class;
    }

    public function getEmployerOrder()
    {
        $employers = DB::table('employers')
            ->select()
            ->where('employers.order', 1)
            ->orderBy('employers.id', 'asc');;
        return $employers;
    }

    public function getEmployer()
    {
        $employers = DB::table('employers')
            ->select('employers.*', DB::raw('(SELECT COUNT(recruitments.id) FROM recruitments WHERE recruitments.employer_id = employers.id AND recruitments.active = 1) AS jobs'))
            ->where('employers.active', 1)
            ->orderBy('employers.id', 'desc');
        return $employers;
    }

    public function addEmployer(array $data)
    {
        try {
            DB::beginTransaction();
            $userCreate = User::create([
                'email'    => $data['email'],
                'password' => bcrypt($data['password']),
                'role'     => $data['role'],
            ]);

            $employerCreate = Employer::create([
                'contact' => $data['contact'],
                'company' => $data['company'],
                'phone'   => $data['phone'],
                'address' => $data['address'],
                'avatar'  => 'https://lh3.googleusercontent.com/pw/ACtC-3eiRUuBNx6i77CFmWtbqrNfo5BMAtCSxwyiIu__bpNMJoFQjzoWx3s8ruzUoWLQQnF-rpEZD1BUfxLbRi-wENhkV2eqqfmiek02SZJYmAEBXRzAQTPuQ2NlXp_BK8GyVcn44ui3NJvy02Azg27H9Pd3=w219-h164-no',
                'photo'   => 'https://lh3.googleusercontent.com/pw/ACtC-3cWYyqg22qB0hNyn-ap2ORo_HJsrEx8wwrtOW1kt8orDhn0jeVUN4bgqIehSy4C22UN8xsfJmytXURP00qX-Tb8D0WdWifk7yv-ILUEonRA2bTvcY-21yOpqcLB38gzSHKbTlkGvZjq0Eu63N6N2WoC=w1743-h979-no',
                'user_id' => $userCreate->id,
            ]);

            DB::commit();
            return true;
        } catch (Exception $ex) {
            DB::rollback();
            return false;
        }
    }

    public function getEmployerByUserId($id)
    {
        $employer = Employer::where('user_id', $id)->get();
        return $employer;
    }

    public function getCandidateSaveByUserId($id)
    {
        $employerId = Employer::where('user_id', $id)->get()->toArray()[0]['id'];

        $candidates = Candidate::select()
            ->whereHas('employers', function ($query) use ($employerId) {
                $query->where('employer_id', $employerId);
            });

        return ($candidates);
    }

    public function getEmployerAdmin()
    {
        $employers = DB::table('employers')
            ->select(
                'employers.id',
                'employers.contact',
                'employers.company',
                'employers.phone',
                'employers.address',
                'employers.website',
                'employers.description',
                'employers.avatar',
                'employers.photo',
                'employers.active',
                'employers.order'
            )
            ->orderBy('employers.id', 'desc');
        return $employers;
    }

    public function dashboardEmployer($id)
    {
        $imployerId                     = Employer::where('user_id', $id)->get()->toArray();
        $quantity_recruitment           = DB::table('recruitments')
            ->leftJoin('employers', 'recruitments.employer_id', '=', 'employers.id')
            ->where('employers.id', $imployerId[0]['id'])
            ->get();
        $quantity_recruitment_active    = DB::table('recruitments')
            ->leftJoin('employers', 'recruitments.employer_id', '=', 'employers.id')
            ->where('employers.id', $imployerId[0]['id'])
            ->where('recruitments.active', '=', 1)
            ->get();
        $quantity_recruitment_no_active = DB::table('recruitments')
            ->leftJoin('employers', 'recruitments.employer_id', '=', 'employers.id')
            ->where('employers.id', $imployerId[0]['id'])
            ->where('recruitments.active', '=', 0)
            ->get();

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
            })->get();

        $data['quantity_recruitment']           = count($quantity_recruitment);
        $data['quantity_recruitment_active']    = count($quantity_recruitment_active);
        $data['quantity_recruitment_no_active'] = count($quantity_recruitment_no_active);
        $data['quantity_candidate']             = count($candidates);

        return $data;
    }
}
