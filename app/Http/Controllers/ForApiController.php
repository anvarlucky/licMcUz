<?php

namespace App\Http\Controllers;


class ForApiController extends Controller
{
    protected $headers;
    protected const CODE_VALIDATION_ERROR = 422;
    protected const CODE_SUCCESS_UPDATED = 202;
    protected const CODE_SUCCESS_CREATED = 201;
    protected const CODE_SUCCESS_DELETED = 202;
    protected const CODE_SUCCESS_FALSE = 555;
    protected const CODE_ACCESS_DENIED = 403;

    public function __construct(){
        $this->headers = [
            'Access-Control-Allow-Origin' => '*',
            'Content-Type' => 'application/json',
            'Content-Transfer-Encoding' => 'utf-8',
            'Language' => app()->getLocale(),
            'Access-Control-Allow-Headers'=> 'Content-Type,Content-Transfer-Encoding, X-Auth-Token, Origin'
        ];
    }

    public function responseSuccess($response){
        return response()->json([
            'data' => $response,
            'send_date'=>date(now())
        ])->withHeaders($this->headers);
    }

    public function responseValidation($response){
        return response()->json([
            'success' => false,
            'errors' => $response
        ], self::CODE_VALIDATION_ERROR)->withHeaders($this->headers);
    }

    public function responseSave($response){
        if($response)
            return response()->json(['success' => true, 'data' => $response], self::CODE_SUCCESS_CREATED)->withHeaders($this->headers);
        return response()->json(['success' => false], self::CODE_SUCCESS_FALSE)->withHeaders($this->headers);
    }

    public function responseUpdate($response){
        if($response)
            return response()->json([
                'success' => true,
                'data' => $response
            ], self::CODE_SUCCESS_UPDATED)->withHeaders($this->headers);
        return response()->json(['success' => false], self::CODE_SUCCESS_FALSE)->withHeaders($this->headers);
    }

    public function responseDelete($response){
        if($response)
            return response()->json(['success' => true], self::CODE_SUCCESS_DELETED)->withHeaders($this->headers);
        return response()->json(['success' => false], self::CODE_SUCCESS_FALSE)->withHeaders($this->headers);
    }
}
