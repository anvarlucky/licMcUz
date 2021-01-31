<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Announcement extends Model
{
    use HasFactory;
    protected $guarded = [];
    public const STORAGE_URL = '/announcement/photo';

    public static function uploadPhoto($uploadFile){
        $filename = time().$uploadFile->getClientOriginalName();
        Storage::disk('local')->putFileAs(
            self::STORAGE_URL,
            $uploadFile,
            $filename
        );
        return $filename;
    }

    public static function getAll()
    {
        return self::all();
    }

    public function shaffofprojects()
    {
        return $this->belongsToMany('App\Models\Shaffofproject','announcement_project','announcement_id','shaffofproject_id');
    }
}
