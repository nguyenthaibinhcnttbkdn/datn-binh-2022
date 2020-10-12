<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recruitment extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }

    public function type_of_work()
    {
        return $this->belongsTo(TypeOfWork::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function career()
    {
        return $this->belongsTo(Career::class);
    }

    public function salary()
    {
        return $this->belongsTo(Salary::class);
    }

    public function candidates()
    {
        return $this->belongsToMany(\App\Models\Candidate::class, 'candidate_recruitments');
    }
}
