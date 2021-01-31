<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [/*'licence_number','licence_given_date','end_date','organization_inn','organization_name','organization_phone','organization_email','district_id','organization_address','organization_director','organization_account_number','difficulty_category','license_direction'*/];


    public static function search($search)
    {
        $certificate = Project::select('*')
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
}
