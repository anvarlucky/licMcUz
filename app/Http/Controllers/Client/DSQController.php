<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseControllerForClient;
use App\Http\Controllers\Controller;
use App\Models\Mountaineering;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class DSQController extends BaseControllerForClient
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
            'Content-type'  => 'application/json'
        ];
        $this->client = new Client(['base_uri' => config('http://192.168.222.1:8193')]);
    }

    public function index(Request $request){
       /* $client = new Client(['base_uri' => 'http://licence.loc']);
        $response = $client->request('GET', 'api/mountaineering');
        $mountes = json_decode($response->getBody());
        foreach ($mountes->Body as $m) {*/
            /*$request = json_encode($m);
            $re = [
                "send_id" => 1,
                "send_date" => 1606471200000,
                "license_name" => "String",
                "address" => "String",
                "phone_number" => 123456789,
                "account_number" => 12345,
                "e_adress" => "String",
                "tin" => "String",
                "pinfl" => 12345,
                "fio_director" => "String",
                "license_number" => 12345,
                "license_date" => 1606471200000,
                "license_term" => 1606471200000,
                "type_of_activity" => "String",
                "license_edit_asosDate" => "String",
                "license_end_asosDate" => "String"
            ];*/

            $client = new Client([
            'headers' => ['Accept'        => 'application/json', 'Content-Type' => 'application/json' ]
            ]);

            $response = $client->post('http://192.168.222.1:8193/api/ministry1',
            ['body' => json_encode(
                [
                    "send_id"=>1,
                    "send_date"=>1606471200000,
                    "license_name"=>"String",
                    "address"=>"String",
                    "phone_number"=>123456789,
                    "account_number"=>1234567891011121314,
                    "e_adress"=>"String",
                    "tin"=>"String",
                    "pinfl"=>12345,
                    "fio_director"=>"String",
                    "license_number"=>02345,
                    "license_date"=>1606471200000,
                    "license_term"=>1606471200000,
                    "type_of_activity"=>"String",
                    "license_edit_asosDate"=>"String",
                    "license_end_asosDate"=>"String"
                ]
            )]
        );
        $re = $response->getBody()->getContents();
        $js = json_decode($re);
        dd($js->success);
            dd($response);
            if($response->success==true){
                echo "Kiritildi";
            }
            else{
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

}
