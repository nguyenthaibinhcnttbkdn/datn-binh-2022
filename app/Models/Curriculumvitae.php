<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curriculumvitae extends Model
{
    protected $guarded = [];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function recruitments()
    {
        return $this->belongsToMany(\App\Models\Recruitment::class, 'cvrecruitments');
    }
}
