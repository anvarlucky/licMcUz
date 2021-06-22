<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseControllerForClient;
use App\Http\Controllers\Controller;
use App\Models\Mountaineering;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DSQController extends BaseControllerForClient
{
    public function index(Request $request){
        $mountaineering = Mountaineering::select('id as send_id','organization_name as license_name','organization_address as address','organization_phone as phone_number',
            'organization_account_number as account_number','organization_email as e_adress','organization_inn as tin','organization_director as fio_director',
            'licence_number as license_number','licence_given_date as license_date','end_date as license_term','license_direction as type_of_activity')->get();
        foreach ($mountaineering as $mount){
        $request = [
            'send_id' => $mount->send_id,
            'send_date' => 21062021,
            'license_name' => $mount->license_name,
            'address' => $mount->address,
            'phone_number' => $mount->phone_number,
            'account_number' => $mount->account_number,
            'e_adress' => $mount->e_adress,
            'tin' => $mount->tin,
            'fio_director' => $mount->fio_director,
            'license_number' => $mount->license_number,
        ];
            //$request1 = json_encode($request);
            //$dsq = $this->post('http://192.168.222.1:8193/api/ministry1',$request1);
            $dsq = Http::post('http://licence.loc/api/mountaineering',$request);
            dd($dsq->status());
        }
        $mountainerring = $this->get('http://licence.loc/api/mountaineering');
        foreach ($mountainerring->Body as $mount){
            $request = json_encode($mount);
            dd(json_encode($request));
            $dsq = $this->post('http://192.168.222.1:8193/api/ministry1',$request);
        }
        dd($dsq);
        if ($dsq->success == true){
            echo "good";
        }
        else{
            echo "bad";
        }
    }
}
