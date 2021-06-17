<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Expertice;
use App\Models\Region;
use App\Models\District;
use App\Http\Requests\ExpetiseRequest;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Exports\ExperticesExport;
use Maatwebsite\Excel\Facades\Excel;

class ExperticeController extends Controller
{

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expertices = Expertice::select('*')->orderBy('licence_given_date', 'desc')->get();
        return view('client.expertise.index',[
            'expertices' => $expertices
        ]);
    }

    public function export()
    {
        return Excel::download(new ExperticesExport, 'Ekspertiza.xlsx');
    }

    public function search(Request $request)
    {
        $search = $request->post('search');
        $expertices = Expertice::search($search);
        return view('client.expertise.index', [
            'expertices' => $expertices
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expertice12 = Expertice::latest()->first();
        $client = new Client(['base_uri' => 'http://talim.mc.uz']);
        $regions = $client->request('GET', 'api/reg');
        $regions = json_decode($regions->getBody());
        $districts = $client->request('GET', 'api/dis');
        $districts = json_decode($districts->getBody());
        return view('client.expertise.create', [
            'expertice12' => $expertice12,
            'regions' => $regions->data,
            'districts' => $districts->data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpetiseRequest $request)
    {
        $request = $request->except('_token');
        $expertice = Expertice::create($request);
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
        if($expertice==true)
            return redirect()->route('expertice.index');
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
        $expertice = Expertice::select('*')->find($id);
        return view('client.expertise.show',[
            'expertice' => $expertice
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
        $expertice = Expertice::select('*')->find($id);
        $client = new Client(['base_uri' => 'http://talim.mc.uz']);
        $regions = $client->request('GET', 'api/reg');
        $regions = json_decode($regions->getBody());
        $districts = $client->request('GET', 'api/dis');
        $districts = json_decode($districts->getBody());
        return view('client.expertise.edit', [
            'expertice' => $expertice,
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
        $expertice = Expertice::select('*')->find($id);
        $expertice->licence_number = $request->licence_number;
        $expertice->licence_given_date =$request->licence_given_date;
        $expertice->end_date = $request->end_date;
        $expertice->organization_inn = $request->organization_inn;
        $expertice->organization_name = $request->organization_name;
        $expertice->organization_phone = $request->organization_phone;
        $expertice->organization_email = $request->organization_email;
        $expertice->region_id = $request->region_id;
        $expertice->district_id = $request->district_id;
        $expertice->organization_address = $request->organization_address;
        $expertice->organization_director = $request->organization_director;
        $expertice->organization_account_number = $request->organization_account_number;
        $expertice->difficulty_category = $request->difficulty_category;
        $expertice->license_direction = $request->license_direction;
        $expertice->licence_number_new = $request->licence_number_new;
        $expertice->save();
        if($expertice == true)
        {
            return redirect()->route('expertice.index');
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
