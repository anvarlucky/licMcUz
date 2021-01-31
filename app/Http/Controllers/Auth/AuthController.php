<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request){
        $request = $request->except('_token');
        if ($request->isMethod('post'))
        {
            $request->email == User::select('email')->get();
            $request->password == User::select('password')->get();
        }
        return view('login');
    }
}
