<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ForApiController;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends ForApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
/*        //$announcements = Announcement::select('id','title','text')->get();
        $announcements = Announcement::where('id',5)->get();
        foreach ($announcements as $announcement) {
            if ($announcement->shaffofproject != null)
            $shaffofproject = $announcement->shaffofprojects;
            foreach ($announcement->shaffofprojects as $shaffofproject) {
                return ['name'=>$shaffofproject->name,'id'=>$shaffofproject->id,'data'=>Announcement::select('id','title')->get()];
            }
            return $this->responseSuccess(Announcement::select('id','title')->get());
        }*/
        return $this->responseSuccess(Announcement::select('id','title')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestAll = $request->except('_token');
        if($request->hasFile('image')) {
            $uploadFile = $request->file('image');
            $fileName = Announcement::uploadPhoto($uploadFile);
            $requestAll['image'] = $fileName;
        }
        else{
            $fileName = null;
        }
        $announcement = new Announcement;
        $announcement->title = $request->title;
        $announcement->text = $request->text;
        $announcement->image = $fileName;
        $announcement->date = $request->date;
        $announcement->save();
        $announcement->shaffofprojects()->attach($request->shaffofprojects);
        if($announcement){
           return $this->responseSave($announcement);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
