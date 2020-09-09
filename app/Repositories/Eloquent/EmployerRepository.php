<?php


namespace App\Repositories\Eloquent;

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
}
