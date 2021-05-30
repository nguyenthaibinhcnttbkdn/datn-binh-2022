<?php

namespace App\Http\Controllers\Client;

use App\Models\Candidate;
use App\Models\Employer;
use App\Repositories\Interfaces\EmployerCvRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EmployerCvController extends Controller
{
    private $employerCvRepository;

    public function __construct(EmployerCvRepositoryInterface $employerCvRepository)
    {
        $this->employerCvRepository = $employerCvRepository;
    }

    public function store(Request $request)
    {
        $data['employer_id'] = Employer::where('user_id', $request->all()['user_id'])->get()->toArray()[0]['id'];
        $data['cv_id'] = $request->all()['cv_id'];

        try {
            $result = $this->employerCvRepository->create($data);
            return $this->sendResult(true, "Create Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Create Failed", [], 400);
        }
    }

    public function getcvsavebyuserid($id){
        $employerId = Employer::where('user_id', $id)->get()->toArray()[0]['id'];
        $listsvsaves = DB::table('employers')
            ->Join('employer_cvs', 'employers.id', '=', 'employer_cvs.employer_id')
            ->Join('curriculumvitaes', 'curriculumvitaes.id', '=', 'employer_cvs.cv_id')
            ->Join('candidates', 'candidates.id', '=', 'curriculumvitaes.candidate_id')
            ->where('employers.id',$employerId)
            ->select(
                'employer_cvs.cv_id',
                        'candidates.name',
                        'candidates.avatar',
                        'candidates.phone',
                        'candidates.position',
                        'candidates.address',
                        'candidates.experience',
                        'candidates.birthday',
            )
            ->get();
        return $this->sendResult(true, "Create Successfully", [$listsvsaves], 200);
    }

    public function getinfoemployer($id){
        $candidateId = Candidate::where('user_id', $id)->get()->toArray()[0]['id'];
        $infoEmployer = DB::table('candidates')
            ->Join('curriculumvitaes', 'curriculumvitaes.candidate_id', '=', 'candidates.id')
            ->Join('employer_cvs', 'curriculumvitaes.id', '=', 'employer_cvs.cv_id')
            ->Join('employers', 'employers.id', '=', 'employer_cvs.employer_id')
            ->where('candidates.id',$candidateId)
            ->select(
                'employers.contact',
                'employers.company',
                'employers.phone',
                'employers.address',
                'employers.website',
                'employers.description',
                'employers.avatar',
                'employers.photo',
                'curriculumvitaes.id as cv_id'
            )
            ->get();
        return $this->sendResult(true, "Create Successfully", [$infoEmployer], 200);
    }

   public function delelecvsave(Request $request){
       $employer_id = Employer::where('user_id', $request->all()['user_id'])->get()->toArray()[0]['id'];

       try {
           DB::table('employer_cvs')
               ->where('employer_cvs.cv_id',$request->all()['cv_id'])
               ->where('employer_cvs.employer_id',$employer_id)
               ->delete();
           return $this->sendResult(true, "Delete Successfully", [], 200);
       } catch (Exception $e) {
           return $this->sendError(false, "Delete Failed", [], 400);
       }

   }
}
