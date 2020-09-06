<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateRecruitment extends Model
{
    protected $guarded = [];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function recruitment()
    {
        return $this->belongsTo(Recruitment::class);
    }
}
