<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recruitments()
    {
        return $this->belongsToMany(\App\Models\Recruitment::class, 'candidate_recruitments');
    }

    public function employers()
    {
        return $this->belongsToMany(\App\Models\Employer::class, 'employer_candidates');
    }
}
