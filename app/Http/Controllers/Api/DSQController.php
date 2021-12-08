<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mountaineering;
use Illuminate\Http\Request;
use App\Http\Controllers\ForApiController;

class DSQController extends ForApiController
{
    public function mount401(){
        $mounts = Mountaineering::all();
        return $this->responseSuccess($mounts);
    }
}
