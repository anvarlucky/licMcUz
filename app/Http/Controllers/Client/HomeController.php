<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Dangerous;
use App\Models\Expertice;
use App\Models\Mountaineering;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Defence;
use App\Models\Bridge;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project_all = Project::select('*')->get()->count();
        $expertise_all = Expertice::select('*')->get()->count();
        $defence_all = Defence::select('*')->get()->count();
        $bridge_all = Bridge::select('*')->get()->count();
        $dangerous_all = Dangerous::select('*')->get()->count();
        $mauntaineering_all = Mountaineering::select('*')->get()->count();
        return view('client.home', [
            'project_all' => $project_all,
            'expertice_all' => $expertise_all,
            'defence_all' => $defence_all,
            'bridge_all' => $bridge_all,
            'dangerous_all' => $dangerous_all,
            'mauntaineering_all' => $mauntaineering_all
        ]);
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
        //
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
