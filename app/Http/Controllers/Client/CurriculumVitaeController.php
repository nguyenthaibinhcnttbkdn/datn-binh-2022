<?php

namespace App\Http\Controllers\Client;

use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CurriculumVitaeRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Exception;


class CurriculumVitaeController extends Controller
{
    private $curriculumVitaeRepository;

    public function __construct(CurriculumVitaeRepositoryInterface $curriculumVitaeRepository)
    {
        $this->middleware(['auth:api', 'scope:candidate'], ['except' => ['store','show','getCurriculumVitaeByCandidateId','update','destroy','getCurriculumVitaeByUserId']]);
        $this->curriculumVitaeRepository = $curriculumVitaeRepository;
    }

    public function saveImgBase64($param, $folder)
    {
        list($extension, $content) = explode(';', $param);
        $tmpExtension = explode('/', $extension);
        preg_match('/.([0-9]+) /', microtime(), $m);
        $fileName       = sprintf('img%s%s.%s', date('YmdHis'), $m[1], $tmpExtension[1]);
        $content        = explode(',', $content)[1];
        $storage        = Storage::disk('public');
        $checkDirectory = $storage->exists($folder);
        if (!$checkDirectory) {
            $storage->makeDirectory($folder);
        }
        $storage->put($folder . '/' . $fileName, base64_decode($content), 'public');
        return $fileName;
    }

    public function store(Request $request)
    {
        try {
            $avatar      = $request->all()['avatar'];
            if(strpos($avatar,'http') !== false){
                $data['avatar'] = $request->all()['avatar'];
            }else {
                $name_avatar = $this->saveImgBase64($avatar, 'uploads');
                $data['avatar']       = 'http://127.0.0.1:8000/storage/uploads/' . $name_avatar;
            }
            $candidateId          = Candidate::where('user_id', $request->only('user_id'))->get()->toArray();
            $data['title']        = $request->all()['title'];
            $data['candidate_id'] = strval($candidateId[0]['id']);
            $data['object']       = json_encode($request->all()['object'], true);
            $result               = $this->curriculumVitaeRepository->create($data);
            return $this->sendResult(true, "Create Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Create Failed", [], 400);
        }
    }

    public function show($id){
        $data = $this->curriculumVitaeRepository->getCurriculumVitaeById($id);
        return $this->sendResult(true, 'Show Successfully', $data, 200);
    }

    public function getCurriculumVitaeByUserId($id){
        $data = $this->curriculumVitaeRepository->getCurriculumVitaeByUserId($id);
        return $this->sendResult(true, 'Show Successfully', $data, 200);
    }

    public function getCurriculumVitaeByCandidateId($id){
        $data = $this->curriculumVitaeRepository->getCurriculumVitaeByCandidateId($id);
        return $this->sendResult(true, 'Show Successfully', $data, 200);
    }

    public function update(Request $request, $id){
        try {
            $avatar      = $request->all()['avatar'];
            if(strpos($avatar,'http') !== false){
                $data['avatar'] = $request->all()['avatar'];
            }else {
                $name_avatar = $this->saveImgBase64($avatar, 'uploads');
                $data['avatar']       = 'http://127.0.0.1:8000/storage/uploads/' . $name_avatar;
            }
          //  $name_avatar = $this->saveImgBase64($avatar, 'uploads');
            $data['title']        = $request->all()['title'];
            $data['object']       = json_encode($request->all()['object'], true);
            $result               = $this->curriculumVitaeRepository->update($id, $data);
            return $this->sendResult(true, "Updated Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Updated Failed", [], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $this->curriculumVitaeRepository->delete($id);
            return $this->sendResult(true, "Delete Successfully", [], 200);
        } catch (Exception $e) {
            return $this->sendError(false, "Delete Failed", [], 400);
        }
    }
}
