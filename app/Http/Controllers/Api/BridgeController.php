<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ForApiController;
use App\Models\Bridge;

class BridgeController extends ForApiController
{
    public function index()
    {
        return $this->responseSuccess(Bridge::getAll());
    }
}
