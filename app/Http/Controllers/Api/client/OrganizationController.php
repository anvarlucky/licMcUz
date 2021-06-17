<?php

namespace App\Http\Controllers\Api\client;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\ForApiController;
use Illuminate\Http\Request;
use App\Models\Organization;

class OrganizationController extends ForApiController
{
    public function index()
    {
        $organizations = Organization::select('*')->get();
        return $this->responseSuccess($organizations);
    }

    public function store(Request $request)
    {
        $request = [
          'company_tin' => $request->company_tin,
          'company_name' => $request->company_name,
          'company_status' => $request->company_status,
          'company_ns10' => $request->company_ns10,
          'company_ns11' => $request->company_ns11,
          'company_adress' => $request->company_adress,
          'performed_service' => $request->performed_service
        ];
        $organization = Organization::create($request);
        if($organization)
        {
            return $this->responseSave($organization);
        }
    }
}
