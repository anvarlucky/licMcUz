<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mountaineering extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function search($search)
    {
        $certificate = Mountaineering::select('*')
            ->where('licence_number', 'like', '%'.$search.'%')
            ->orWhere('licence_number_new', 'like', '%'.$search.'%')
            ->get();
        return $certificate;
    }

    public function district()
    {
        return $this->belongsTo('App\Models\District', 'district_id');
    }

    public function region()
    {
        return $this->belongsTo('App\Models\Region', 'region_id');
    }

    public static function getAll()
    {
        return self::all();
    }

    public function types()
    {
        return $this->belongsToMany('App\Models\Type','mountaineering_types','mountaineering_id','type_id');
    }
}
