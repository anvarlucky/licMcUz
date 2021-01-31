<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function defences(){
        return $this->belongsToMany('App\Models\Defence', 'defence_types','type_id','defence_id');
    }
}
