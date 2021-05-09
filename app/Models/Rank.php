<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $guarded = [];

    public function recruitments()
    {
        return $this->hasMany(Recruitment::class);
    }
}
