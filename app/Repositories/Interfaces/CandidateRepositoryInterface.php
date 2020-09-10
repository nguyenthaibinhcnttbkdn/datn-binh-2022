

namespace App\Repositories\Interfaces;


interface CandidateRepositoryInterface
{
    public function getCandidateOrder();

    public function getCandidate();

    public function addCandidate(array $data);

    public function getCandidateByUserId($id);

    public function getRecruitmentByUserId($id);
}
