<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\BaseControllerForClient;
use Illuminate\Http\Request;

class AnnouncementController extends BaseControllerForClient
{
    public function index()
    {
        $response = $this->get('https://lic.mc.uz/api/admin/announcements');
        return view('admin.announcements.index',[
            'announcements' => $response->data
        ]);
    }

    public function create()
    {
        $response = $this->get('https://lic.mc.uz/api/admin/shaffofprojects');
        return view('admin.announcements.create',[
            'shaffofprojects' => $response->data,
        ]);
    }

    public function store(Request $request)
    {
        $request = $request->except('_token');
        $announcement = $this->put('https://lic.mc.uz/api/admin/announcements',$request,true,'image');
        if($announcement == true)
        {
            return redirect()->route('announcements.index');
        }
    }
}
