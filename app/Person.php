<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $guarded = [];

    public function getProperNameAttribute()
    {
        return \title_case(str_replace('_', ' ', $this->name));
    }

}
