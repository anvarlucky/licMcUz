<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Mountaineering;
use App\Models\Region;
use App\Models\District;
use App\Http\Requests\MountaineeringRequest;
use GuzzleHttp\Client;
use App\Exports\MountaineeringExport;
use Maatwebsite\Excel\Facades\Excel;

class MountaineeringController extends Controller
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
        $mauntaineeringes = Mountaineering::select('*')->orderBy('licence_given_date', 'desc')->get();
        return view('client.mauntaineering.index',[
            'mauntaineeringes' => $mauntaineeringes
        ]);
    }

    public function export()
    {
        return Excel::download(new MountaineeringExport, 'BalandlikAlpinzmMudofaa.xlsx');
    }


    public function search(Request $request)
    {
        $search = $request->post('search');
        $mauntaineeringes = Mountaineering::search($search);
        return view('client.mauntaineering.index', [
            'mauntaineeringes' => $mauntaineeringes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mauntaineering12 = Mountaineering::latest()->first();
        $client = new Client(['base_uri' => 'http://talim.mc.uz']);
        $regions = $client->request('GET', 'api/reg');
        $regions = json_decode($regions->getBody());
        $districts = $client->request('GET', 'api/dis');
        $districts = json_decode($districts->getBody());
        $types = Type::select('*')->get();
        return view('client.mauntaineering.create', [
            'mauntaineering12' => $mauntaineering12,
            'regions' => $regions->data,
            'districts' => $districts->data,
            'types' => $types
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MountaineeringRequest $request)
    {
        $request1 = $request->except(['types','_token']);
        $mountaineering = Mountaineering::create($request1);
        if($mountaineering==true){
            $mountaineering->types()->attach($request->types);
            if($mountaineering==true)
                return redirect()->route('mauntaineering.index');
            else
                return redirect()->back()->withErrors();
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
        $mauntaineering = Mountaineering::select('*')->find($id);
        return view('client.mauntaineering.show',[
            'mauntaineering' => $mauntaineering
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
        $mauntaineering = Mountaineering::select('*')->find($id);
        $types = Type::select('*')->get();
        $client = new Client(['base_uri' => 'http://talim.mc.uz']);
        $regions = $client->request('GET', 'api/reg');
        $regions = json_decode($regions->getBody());
        $districts = $client->request('GET', 'api/dis');
        $districts = json_decode($districts->getBody());
        return view('client.mauntaineering.edit', [
            'mauntaineering' => $mauntaineering,
            'regions' => $regions->data,
            'districts' => $districts->data,
            'types' => $types
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
        $mauntaineering = Mountaineering::select('*')->find($id);
        $mauntaineering->licence_number = $request->licence_number;
        $mauntaineering->licence_given_date =$request->licence_given_date;
        $mauntaineering->end_date = $request->end_date;
        $mauntaineering->organization_inn = $request->organization_inn;
        $mauntaineering->organization_name = $request->organization_name;
        $mauntaineering->organization_phone = $request->organization_phone;
        $mauntaineering->organization_email = $request->organization_email;
        $mauntaineering->region_id = $request->region_id;
        $mauntaineering->district_id = $request->district_id;
        $mauntaineering->organization_address = $request->organization_address;
        $mauntaineering->organization_director = $request->organization_director;
        $mauntaineering->organization_account_number = $request->organization_account_number;
        $mauntaineering->difficulty_category = $request->difficulty_category;
        $mauntaineering->license_direction = $request->license_direction;
        $mauntaineering->licence_number_new = $request->licence_number_new;
        $mauntaineering->save();
        if($mauntaineering == true)
        {
            return redirect()->route('mauntaineering.index');
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
