<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curriculumvitae extends Model
{
    use SoftDeletes;

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
