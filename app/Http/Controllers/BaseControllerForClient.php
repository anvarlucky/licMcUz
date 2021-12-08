<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class BaseControllerForClient extends Controller
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
            'Content-Type' =>   'application/json',
            'Charset'      =>'utf-8',
            //'Language'      => app()->getLocale(),
            //'_token' => csrf_token()
        ];
        $this->client = new Client(['base_uri' => config('http://192.168.222.1:8193')]);
    }

    public function __construct2()
    {
        $this->middleware(function ($request, $next) {
            if(!session()->has('access-token') && Route::current()->uri != 'auth/login' && Route::current()->uri != '/' && !Request::is('calculator' || 'calculator/*')){
                return Redirect::to('/')->send();
            }
            $this->headers = [
                //'Authorization' => 'Bearer '.session('access-token'),
                'Accept'        => 'application/json',
                //'Language'      => app()->getLocale()
            ];
            return $next($request);
        });
        $this->client = new Client(['base_uri' => config('app.api_url')]);
    }

    public function post($url, $request, $fileAttributes = []) {

        try {
            $response = $this->client->request('POST', $url, ['json' => $request, 'headers' => $this->headers]);

            if($response->getStatusCode() == self::CODE_VALIDATION_SUCCESS || $response->getStatusCode() == self::CODE_SUCCESS_UPDATED || $response->getStatusCode() == self::CODE_SUCCESS_CREATED) {
                return json_decode($response->getBody());
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return $this->errorResponse($e, $request);
        }

    }

    public function get($url, $request = []) {
        try {
            if(!empty($request)) {
                $params = [];
                foreach($request as $k => $r) {
                    $params[] = $k.'='.$r;
                }
                $url = $url.'?'.implode('&', $params);
            }
            $response = $this->client->request('GET', $url, ['headers' => $this->headers]);
            return json_decode($response->getBody());
        }
        catch (\GuzzleHttp\Exception\RequestException $e) {
            return $this->errorResponse($e, $request);
        }
    }

    public function put($url, $request, $file = false, $fileName = 'image', $base64 = false) {
        try{
            if($file){
                if(isset($request[$fileName])) {
                    if(is_array($request[$fileName])) {
                        $fileNameArr = $fileName."[]";
                        foreach ($request[$fileName] as $key => $photo) {
                            if ($base64) {
                                $multipart[] = $this->setBase64File($photo, $fileNameArr);
                            } else {
                                $multipart[] = $this->setFile($photo, $fileNameArr);
                            }
                        }
                    }else{
                        if ($base64) {
                            $multipart[] = $this->setBase64File($request[$fileName], $fileName);
                        } else {
                            $multipart[] = $this->setFile($request[$fileName], $fileName);
                        }
                    }
                }
                unset($request[$fileName]);
                foreach ($request as $key => $values){
                    if(is_array($values)) {
                        foreach($values as $k => $value) {
                            $multipart[] = [
                                'name' => "{$key}[{$k}]",
                                'contents' => is_array($value)?json_encode($value):$value,
                            ];
                        }
                    }else {
                        $multipart[] = [
                            'name' => $key,
                            'contents' => is_array($values)?json_encode($values):$values,
                        ];
                    }
                }
                $response = $this->client->request('POST', $url, [
                    'headers' => $this->headers,
                    'multipart' => $multipart,
                ]);
            }else {
                $response = $this->client->request('PUT', $url, [
                    'form_params' => $request,
                    'headers' => $this->headers,
                ]);
            }
            return json_decode($response->getBody());
        }  catch (\GuzzleHttp\Exception\RequestException $e) {
            return $this->errorResponse($e, $request);
        }

    }

    public function delete($url, $request=[]) {
        $response = $this->client->request('DELETE', $url, ['form_params' => $request, 'headers' => $this->headers]);
        return json_decode($response->getBody());
    }

    private function setFile($photo, $fileName){
        return [
            'name' => "{$fileName}",
            'contents' =>  File::get($photo->getPathname()),
            'filename' => $photo->getClientOriginalName()
        ];
    }

    private function setBase64File($photo, $fileName){
        return [
            'name' => "{$fileName}",
            'contents' =>  $photo,
            'filename' => uniqid().time() . ".jpg"
        ];
    }

    private function errorResponse($e, $request) {
        switch ($e->getCode()){
            case self::CODE_VALIDATION_ERROR:
                if(Request::ajax()){
                    return json_decode($e->getResponse()->getBody());
                }
                return back()->withErrors(json_decode($e->getResponse()->getBody())->errors)->withInput($request)->send();
                break;
            case self::CODE_ACCESS_DENIED:
                return abort(403, __('admin.accessDenied'));
                break;
            case self::CODE_UNAUTHORIZED:
                return Redirect::to('/')->send();
                break;
            case self::CODE_NOTFOUND:
                return abort(404, 'page not found');
                break;
            case self::CODE_MANY_REQUESTS:
                return abort(429, 'to many requests');
                break;
            default:
                if(config('app.debug')){
                    dd($e->getCode(), json_decode($e->getResponse()->getBody()));
                }
                return abort(500);
                break;
        }

    }

    protected function view($url, $params = []){
        return view($this->viewPath.'.'.$url, $params);
    }
}
