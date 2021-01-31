<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Models\Defence;
use App\Models\Region;
use App\Models\District;
use App\Http\Requests\DefenceRequest;
use GuzzleHttp\Client;


class DefenceController extends Controller
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
        $defences = Defence::select('*')->get();
        return view('client.defence.index',[
            'defences' => $defences
        ]);
    }


    public function search(Request $request)
    {
        $search = $request->post('search');
        $defences = Defence::search($search);
        return view('client.defence.index', [
            'defences' => $defences
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
/*        $client = new Client(['base_uri' => 'http://talim.mc.uz']);
        $regions = $client->request('GET', 'api/reg');
        $regions = json_decode($regions->getBody());*/
        $client = new Client(['base_uri' => 'http://talim.mc.uz']);
        $regions = $client->request('GET', 'api/reg');
        $regions = json_decode($regions->getBody());
        $districts = $client->request('GET', 'api/dis');
        $districts = json_decode($districts->getBody());
        $types = Type::select('*')->get();
/*        $districts = $client->request('GET', 'api/dis');
        $districts = json_decode($districts->getBody());

        $newClient = new Client(['base_uri' => 'http://api.mc.uz/']);
        $organization = $newClient->request('GET','info-by-inn/303018069');
        $organization = json_decode($organization->getBody());*/
        //dd($organization);
        return view('client.defence.create', [
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
    public function store(DefenceRequest $request)
    {
        $request1 = $request->except(['types','_token']);
        $defence = Defence::create($request1);
        if($defence==true){
        $defence->types()->attach($request->types);
        if($defence==true)
                return redirect()->route('defence.index');
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
        $defence = Defence::select('*')->find($id);
        return view('client.defence.show',[
            'defence' => $defence
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
        $defence = Defence::select('*')->find($id);
        $client = new Client(['base_uri' => 'http://talim.mc.uz']);
        $regions = $client->request('GET', 'api/reg');
        $regions = json_decode($regions->getBody());
        $districts = $client->request('GET', 'api/dis');
        $districts = json_decode($districts->getBody());
        $types = Type::select('*')->get();
        return view('client.defence.edit', [
            'defence' => $defence,
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
        $defence = Defence::select('*')->find($id);
        $defence->licence_number = $request->licence_number;
        $defence->licence_given_date =$request->licence_given_date;
        $defence->end_date = $request->end_date;
        $defence->organization_inn = $request->organization_inn;
        $defence->organization_name = $request->organization_name;
        $defence->organization_phone = $request->organization_phone;
        $defence->organization_email = $request->organization_email;
        $defence->region_id = $request->region_id;
        $defence->district_id = $request->district_id;
        $defence->organization_address = $request->organization_address;
        $defence->organization_director = $request->organization_director;
        $defence->organization_account_number = $request->organization_account_number;
        $defence->difficulty_category = $request->difficulty_category;
        $defence->license_direction = $request->license_direction;
        $defence->licence_number_new = $request->licence_number_new;
        $defence->save();
        if($defence == true)
        {
            return redirect()->route('defence.index');
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
