<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $guarded = [];

    public function recruitments()
    {
        return $this->hasMany(Recruitment::class);
    }
}
