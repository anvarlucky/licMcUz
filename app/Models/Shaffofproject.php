<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shaffofproject extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $table = 'shaffofprojects';

    public static function getAll()
    {
        return self::all();
    }

    public function announcements()
    {
        return $this->belongsToMany('App\Models\Announcement','announcement_project','shaffofproject_id','announcement_id');
    }
}
