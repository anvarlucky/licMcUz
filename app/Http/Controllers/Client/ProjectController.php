<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Region;
use App\Models\District;
use App\Models\Type;
use GuzzleHttp\Client;
use App\Exports\LicencesExport;
use Maatwebsite\Excel\Facades\Excel;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    protected const CODE_VALIDATION_SUCCESS = 200;
    protected const CODE_VALIDATION_ERROR = 422;
    protected const CODE_MANY_REQUESTS = 429;
    protected const CODE_SUCCESS_UPDATED = 202;
    protected const CODE_SUCCESS_CREATED = 201;
    protected const CODE_SUCCESS_DELETED = 202;
    protected const CODE_UNAUTHORIZED = 401;
    protected const CODE_NOTFOUND = 404;
    protected const CODE_ACCESS_DENIED = 403;
    protected $client;

    public function __construct()
    {
        $this->headers = [
            'Accept'        => 'application/json',
            'Language'      => app()->getLocale()
        ];
        $this->client = new Client(['base_uri' => config('app.api_url')]);
    }

    public function index()
    {
        $projects = Project::select('*')->orderBy('licence_given_date', 'desc')->get();

        $client = new Client(['base_uri' => 'http://talim.mc.uz']);
        $region = $client->request('GET', 'api/reg/');
        $region = json_decode($region->getBody());
        $district = $client->request('GET', 'api/dis');
        $district = json_decode($district->getBody());
        return view('client.projects.index',[
            'projects' => $projects,
            'district' => $district->data,
            'region' => $region->data,
        ]);
    }

    public function export()
    {
        return Excel::download(new LicencesExport, 'Loyiha.xlsx');
    }


    public function search(Request $request)
    {
        $search = $request->post('search');
        $project = Project::search($search);
        return view('client.projects.index', [
            'projects' => $project
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project12 = Project::latest()->first();
        $client = new Client(['base_uri' => 'http://talim.mc.uz']);
        $regions = $client->request('GET', 'api/reg');
        $regions = json_decode($regions->getBody());
        $districts = $client->request('GET', 'api/dis');
        $districts = json_decode($districts->getBody());
       /* $regions = Region::select('*')->get();
        $districts = District::select('*')->get();*/
        $types = Type::select('*')->get();
        return view('client.projects.create', [
            'project12' => $project12,
            'regions' => $regions->data,
            'districts' => $districts->data,
            'types' => $types
        ]);
    }

    public function createNew()
    {
        $client = new Client(['base_uri' => 'https://api.mc.uz']);
        $dataFromApis = $client->request('GET', '/info-by-inn/306930674');
        $dataFromApi = json_decode($dataFromApis->getBody());
        return $dataFromApi;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $request = $request->except('_token');
        //dd($request);
        $project = Project::create($request);
        /*if($project && $request->type_id)
        {
            foreach($request->type_id as $typeId)
            {
                $projectType = new ProjectType();
                $projectType->project_id = $project->id;
                $projectType->type_id = $typeId;
                $projectType->save();
            }
        }*/
        if($project==true)
            return redirect()->route('projects.index');
        else
            return redirect()->back()->withErrors();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::select('*')->find($id);
        return view('client.projects.show',[
            'project' => $project
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::select('*')->find($id);
        $client = new Client(['base_uri' => 'http://talim.mc.uz']);
        $regions = $client->request('GET', 'api/reg');
        $regions = json_decode($regions->getBody());
        $districts = $client->request('GET', 'api/dis');
        $districts = json_decode($districts->getBody());
        return view('client.projects.edit', [
            'project' => $project,
            'regions' => $regions->data,
            'districts' => $districts->data
        ]);
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
        $project = Project::select('*')->find($id);
        $project->licence_number = $request->licence_number;
        $project->licence_given_date =$request->licence_given_date;
        $project->end_date = $request->end_date;
        $project->organization_inn = $request->organization_inn;
        $project->organization_name = $request->organization_name;
        $project->organization_phone = $request->organization_phone;
        $project->organization_email = $request->organization_email;
        $project->region_id = $request->region_id;
        $project->district_id = $request->district_id;
        $project->organization_address = $request->organization_address;
        $project->organization_director = $request->organization_director;
        $project->organization_account_number = $request->organization_account_number;
        $project->difficulty_category = $request->difficulty_category;
        $project->license_direction = $request->license_direction;
        $project->licence_number_new = $request->licence_number_new;
        $project->save();
        if($project == true)
        {
            return redirect()->route('projects.index');
        }

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
