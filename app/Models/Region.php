<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    public function projects()
    {
        return $this->hasMany('Project');
    }

    public function districts()
    {
        return $this->hasMany('District');
    }
    public function expertices()
    {
        return $this->hasMany('Expertice');
    }

    public function defences(){
        return $this->hasMany('Defence');
    }

}
