<?php


namespace App\Repositories\Eloquent;

use App\Models\Candidate;
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
            ->where('employers.order', '<>', null)
            ->orderBy('employers.order', 'asc');;
        return $employers;
    }

    public function getEmployer()
    {
        $employers = DB::table('employers')
            ->select()
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
                'avatar'  => 'https://scontent.fdad2-1.fna.fbcdn.net/v/t1.0-9/118692222_327425445243548_5214214997457116906_n.jpg?_nc_cat=109&_nc_sid=e007fa&_nc_ohc=seKeZmjEARkAX_wTpVx&_nc_ht=scontent.fdad2-1.fna&oh=a7d16d73b8773f06d07920ebbb15bbf2&oe=5F7E1511',
                'photo'   => 'https://scontent-hkg4-2.xx.fbcdn.net/v/t1.0-9/117936800_318042479515178_5679268451815365577_o.jpg?_nc_cat=104&_nc_sid=8024bb&_nc_ohc=xSCel1s8dzoAX818c5t&_nc_ht=scontent-hkg4-2.xx&oh=240697b22745bf5c2f6ef47d8f6b1f0a&oe=5F6BA47B',
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
}
