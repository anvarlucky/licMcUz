<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Mountaineering;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class DSQController extends Controller
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


    //410-son bo`yicha
    public function mountaineering(Request $request)
    {
        dd(time());
        $clientGet = new Client(['base_uri' => 'http://lic.mc.uz']);
        $response = $clientGet->request('GET', 'api/mountaineering');
        $mountes = json_decode($response->getBody());
        $client = new Client([
            'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/json']
        ]);
        foreach ($mountes->Body as $mount){
            $response = $client->post('http://192.168.222.1:8193/api/ministry1',
                ['body' => json_encode(
                    [
                        "send_id" => $mount->send_id,
                        "send_date" => time() * 1000,
                        "license_name" => $mount->license_name,
                        "address" => $mount->address,
                        //"phone_number" => $mount->phone_number,
                        //"account_number" => $mount->account_number,
                        "e_adress" => $mount->e_adress,
                        "tin" => $mount->tin,
                        "pinfl" => null,
                        "fio_director" => $mount->fio_director,
                        //"license_number"=>$mount->license_number,
                        "license_date" => strtotime($mount->license_date)*1000,
                        "license_term" => strtotime($mount->license_term)*1000,
                        "type_of_activity" => $mount->type_of_activity,
                        "license_edit_asosDate" => null,
                        "license_end_asosDate" => null
                    ]
                )]
            );
           /* $re = $response->getBody()->getContents();
            $js = json_decode($re);
            dd($js);*/
    }
        $re = $response->getBody()->getContents();
        $js = json_decode($re);
        if ($js->success == true) {
            echo "Kiritildi";
        } else {
            echo "Qaytadan kodni tekshiring!";
        }
        $req = json_encode($re);
        $dsqClient = new Client();
        $res = $dsqClient->post('http://192.168.222.1:8193/api/ministry1', ['json' => $req, 'headers' => $this->headers]);
        dd($res);
        if ($res->getStatusCode()) {
            return "success";
        }
    }

    //381-son bo'yicha projects table
    public function projects(Request $request){
        dd(time());
        $clientGet = new Client(['base_uri' => 'http://lic.mc.uz']);
        $response = $clientGet->request('GET', 'api/mountaineering');
        $mountes = json_decode($response->getBody());
        $client = new Client([
            'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/json']
        ]);
        foreach ($mountes->Body as $mount){
            $response = $client->post('http://192.168.222.1:8193/api/ministry1',
                ['body' => json_encode(
                    [
                        "send_id" => $mount->send_id,
                        "send_date" => time() * 1000,
                        "license_name" => $mount->license_name,
                        "address" => $mount->address,
                        //"phone_number" => $mount->phone_number,
                        //"account_number" => $mount->account_number,
                        "e_adress" => $mount->e_adress,
                        "tin" => $mount->tin,
                        "pinfl" => null,
                        "fio_director" => $mount->fio_director,
                        //"license_number"=>$mount->license_number,
                        "license_date" => strtotime($mount->license_date)*1000,
                        "license_term" => strtotime($mount->license_term)*1000,
                        "type_of_activity" => $mount->type_of_activity,
                        "license_edit_asosDate" => null,
                        "license_end_asosDate" => null
                    ]
                )]
            );
            /* $re = $response->getBody()->getContents();
             $js = json_decode($re);
             dd($js);*/
        }
        $re = $response->getBody()->getContents();
        $js = json_decode($re);
        if ($js->success == true) {
            echo "Kiritildi";
        } else {
            echo "Qaytadan kodni tekshiring!";
        }
        $req = json_encode($re);
        $dsqClient = new Client();
        $res = $dsqClient->post('http://192.168.222.1:8193/api/ministry1', ['json' => $req, 'headers' => $this->headers]);
        dd($res);
        if ($res->getStatusCode()) {
            return "success";
        }
    }

    //???
    public function expertice(Request $request){

    }

}
