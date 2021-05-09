<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recruitments()
    {
        return $this->hasMany(Recruitment::class);
    }
}
