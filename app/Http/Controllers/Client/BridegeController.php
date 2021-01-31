<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Models\Bridge;
use App\Models\Region;
use App\Models\District;
use App\Http\Requests\BridgeRequest;
use GuzzleHttp\Client;

class BridegeController extends Controller
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
        $bridges = Bridge::select('*')->get();
        return view('client.bridge.index',[
            'bridges' => $bridges
        ]);
    }


    public function search(Request $request)
    {
        $search = $request->post('search');
        $bridges = Bridge::search($search);
        return view('client.bridge.index', [
            'bridges' => $bridges
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client = new Client(['base_uri' => 'http://talim.mc.uz']);
        $regions = $client->request('GET', 'api/reg');
        $regions = json_decode($regions->getBody());
        $districts = $client->request('GET', 'api/dis');
        $districts = json_decode($districts->getBody());
        $types = Type::select('*')->get();
        return view('client.bridge.create', [
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
    public function store(BridgeRequest $request)
    {
/*        $request = $request->except('_token');
        $bridge = Bridge::create($request);

                if($bridge==true)
                    return redirect()->route('bridge.index');
                else
                    return redirect()->back()->withErrors();*/
        $request1 = $request->except(['types','_token']);
        $bridge = Bridge::create($request1);
        if($bridge==true){
            $bridge->types()->attach($request->types);
            if($bridge==true)
                return redirect()->route('bridge.index');
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
        $bridge = Bridge::select('*')->find($id);
        return view('client.bridge.show',[
            'bridge' => $bridge
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
        $bridge = Bridge::select('*')->find($id);
        $types = Type::select('*')->get();
        $client = new Client(['base_uri' => 'http://talim.mc.uz']);
        $regions = $client->request('GET', 'api/reg');
        $regions = json_decode($regions->getBody());
        $districts = $client->request('GET', 'api/dis');
        $districts = json_decode($districts->getBody());
        return view('client.bridge.edit', [
            'bridge' => $bridge,
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
        $bridge = Bridge::select('*')->find($id);
        $bridge->licence_number = $request->licence_number;
        $bridge->licence_given_date =$request->licence_given_date;
        $bridge->end_date = $request->end_date;
        $bridge->organization_inn = $request->organization_inn;
        $bridge->organization_name = $request->organization_name;
        $bridge->organization_phone = $request->organization_phone;
        $bridge->organization_email = $request->organization_email;
        $bridge->region_id = $request->region_id;
        $bridge->district_id = $request->district_id;
        $bridge->organization_address = $request->organization_address;
        $bridge->organization_director = $request->organization_director;
        $bridge->organization_account_number = $request->organization_account_number;
        $bridge->difficulty_category = $request->difficulty_category;
        $bridge->license_direction = $request->license_direction;
        $bridge->licence_number_new = $request->licence_number_new;
        $bridge->save();
        if($bridge == true)
        {
            return redirect()->route('bridge.index');
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
