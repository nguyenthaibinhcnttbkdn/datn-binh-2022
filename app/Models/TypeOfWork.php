<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeOfWork extends Model
{
    protected $guarded = [];

    public function recruitments()
    {
        return $this->hasMany(Recruitment::class);
    }
}
