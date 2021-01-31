<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    use HasFactory;

    const UPDATED_AT = null;
    protected $primaryKey = null;
    public $incrementing = false;
    protected $table = 'project_types';
    public $timestamps = ['created_at', 'deleted_at'];
    protected $fillable = ['project_id','type_id'];


    public static function getProjectTypes($id){
        return self::select('project_id', 'type_id')
            ->leftJoin('types as t', 't.id', 'project_types.type_id')
            ->where(['project_id' => $id])->get();
    }

}


