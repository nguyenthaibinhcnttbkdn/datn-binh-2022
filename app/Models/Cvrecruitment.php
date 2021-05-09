<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cvrecruitment extends Model
{
    protected $guarded = [];

    public function curriculumvitae()
    {
        return $this->belongsTo(Curriculumvitae::class);
    }

    public function recruitments()
    {
        return $this->belongsTo(Recruitment::class);
    }
}
