<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Dangerous;
use App\Models\Region;
use App\Models\District;
use App\Http\Requests\DangerousRequest;
use GuzzleHttp\Client;
class DangerousController extends Controller
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
        $dangerouses = Dangerous::select('*')->get();
        return view('client.dangerous.index',[
            'dangerouses' => $dangerouses
        ]);
    }


    public function search(Request $request)
    {
        $search = $request->post('search');
        $dangerous = Dangerous::search($search);
        return view('client.dangerous.index', [
            'dangerous' => $dangerous
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
        return view('client.dangerous.create', [
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
    public function store(DangerousRequest $request)
    {
/*        $request = $request->except('_token');
        $dangerous = Dangerous::create($request);*/
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

        /*        $item = new Defence();
                $data = $request->All();
                $item->fill($data)->save();
                $lastAdded = Defence::all()->last()->id;
                foreach ($data['types'] as $type) {
                    $item->types()->attach($lastAdded, ['defence_id' => $lastAdded, 'type_id' => $type]);
                }*/
//dd($request->except('_token'));
        //$bridge = new Bridge();
        //  $bridge->fill($request->all())->save();
        //$request = $request->except('_token');
        //dd($request);
        //$defence = Defence::create($request);
        //dd($defence);
        // $bridge->types()->attach($request['types'],true);
        $request1 = $request->except(['types','_token']);
        $dangerous = Dangerous::create($request1);
        if($dangerous==true){
            $dangerous->types()->attach($request->types);
            if($dangerous==true)
                return redirect()->route('dangerous.index');
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
        $dangerous = Dangerous::select('*')->find($id);
        return view('client.dangerous.show',[
            'dangerous' => $dangerous
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
        $dangerous = Dangerous::select('*')->find($id);
        $types = Type::select('*')->get();
        $client = new Client(['base_uri' => 'http://talim.mc.uz']);
        $regions = $client->request('GET', 'api/reg');
        $regions = json_decode($regions->getBody());
        $districts = $client->request('GET', 'api/dis');
        $districts = json_decode($districts->getBody());
        return view('client.dangerous.edit', [
            'dangerous' => $dangerous,
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
        $dangerous = Dangerous::select('*')->find($id);
        $dangerous->licence_number = $request->licence_number;
        $dangerous->licence_given_date =$request->licence_given_date;
        $dangerous->end_date = $request->end_date;
        $dangerous->organization_inn = $request->organization_inn;
        $dangerous->organization_name = $request->organization_name;
        $dangerous->organization_phone = $request->organization_phone;
        $dangerous->organization_email = $request->organization_email;
        $dangerous->region_id = $request->region_id;
        $dangerous->district_id = $request->district_id;
        $dangerous->organization_address = $request->organization_address;
        $dangerous->organization_director = $request->organization_director;
        $dangerous->organization_account_number = $request->organization_account_number;
        $dangerous->difficulty_category = $request->difficulty_category;
        $dangerous->license_direction = $request->license_direction;
        $dangerous->licence_number_new = $request->licence_number_new;
        $dangerous->save();
        if($dangerous == true)
        {
            return redirect()->route('dangerous.index');
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
