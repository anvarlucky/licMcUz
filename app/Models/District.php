<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    public function projects()
    {
        return $this->hasMany('Project');
    }

    public function region()
    {
        return $this->belongsTo('Region');
    }

    public function expertices(){
        return $this->hasMany('Expertice');
    }

    public function defences(){
        return $this->hasMany('Defence');
    }
}
