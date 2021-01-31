<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\BaseControllerForClient;
use Illuminate\Http\Request;

class ShaffofProjectController extends BaseControllerForClient
{

    public function index()
    {
        $response = $this->get('http://licence.loc/api/admin/shaffofprojects');
        return view('admin.shaffofprojects.index',[
            'shaffofprojects' => $response->data
        ]);
    }

    public function create()
    {
        return view('admin.shaffofprojects.create');
    }

    public function store(Request $request)
    {
        $request = $request->except('_token');
        $response = $this->post('http://licence.loc/api/admin/shaffofprojects',$request);
        if($response ==true)
        {
            return redirect()->route('shaffofprojects.index');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
