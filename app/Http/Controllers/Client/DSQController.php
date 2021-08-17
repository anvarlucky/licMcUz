<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Mountaineering;
use App\Models\Project;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
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


    //410-son bo`yicha mountaineering table
    public function mountaineering(Request $request)
    {
        $clientGet = new Client(['base_uri' => 'http://licence.loc/']);
        $response = $clientGet->request('GET', 'api/mountaineering');
        $mountes = json_decode($response->getBody());
        $client = new Client([
            'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/json']
        ]);
        //!!!!! GNK serveri psda jonatiladigan danniylar to'g'ri!!!!
        foreach ($mountes->Body as $mount) {
                $response1 = $client->post('http://certificate.loc/api/ministry1',
                    [
                        'body' => json_encode([
                            "send_id" => $mount->send_id,
                            "send_date" => time() * 1000,
                            "license_name" => $mount->license_name,
                            "address" => $mount->address,
                            "phone_number" => str_replace([' ', '-'], '', $mount->phone_number),
                            "account_number" => str_replace(' ', '', $mount->account_number),
                            "e_adress" => $mount->e_adress,
                            "tin" => str_replace(' ', '', $mount->tin),
                            "pinfl" => null,
                            "fio_director" => $mount->fio_director,
                            "license_number" => $mount->license_number,
                            "license_date" => strtotime($mount->license_date) * 1000,
                            "license_term" => strtotime($mount->license_term) * 1000,
                            "type_of_activity" => $mount->type_of_activity,
                            "license_edit_asosDate" => null,
                            "license_end_asosDate" => null
                        ])
                    ]);
                if ($response1->getStatusCode() == 201) {
                    Mountaineering::where('id',$mount->send_id)->update(['status_gnk' => 1]);
                }
                dump($mount->send_id . ' Yuborildi');
        }
    }

    //381-son bo'yicha projects table
    public function projects(Request $request){
        $clientGet = new Client(['base_uri' => 'http://licence.loc']);
        $response = $clientGet->request('GET', 'api/projects');
        $projects = json_decode($response->getBody());
        $client = new Client([
            'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/json']
        ]);
        foreach ($projects->Body as $project){
            $response2 = $client->post('http://certificate.loc/api/ministry2',
                ['body' => json_encode(
                    [
                        "send_id" => $project->send_id,
                        "send_date" => time() * 1000,
                        "license_name" => $project->license_name,
                        "address" => $project->address,
                        "phone_number" => str_replace([' ', '-'], '', $project->phone_number),
                        "account_number" => str_replace(' ', '', $project->account_number),
                        "e_adress" => $project->e_adress,
                        "tin" => str_replace(' ', '', $project->tin),
                        "pinfl" => null,
                        "fio_director" => $project->fio_director,
                        "license_number"=>$project->license_number,
                        "license_date" => strtotime($project->license_date)*1000,
                        //"license_term" => strtotime($project->license_term)*1000,
                        "complexity_category" => $project->complexity_category,
                        "type_of_activity" => $project->type_of_activity,
                        "license_edit_asosDate" => null,
                        "license_end_asosDate" => null
                    ]
                )]
            );
            if ($response2->getStatusCode()==201){
                Project::where('id',$project->send_id)->update(['status_gnk' => 1]);
                dump($project->send_id. ' Yuborildi');
            }
        }
    }

    //???
    public function expertice(Request $request){

    }

}
