<?php


namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\SalaryRepositoryInterface;
use App\Models\Salary;

class SalaryRepository extends BaseRepository implements SalaryRepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Salary::class;
    }
}
