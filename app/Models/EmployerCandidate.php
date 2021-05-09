<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployerCandidate extends Model
{
    protected $guarded = [];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
}
