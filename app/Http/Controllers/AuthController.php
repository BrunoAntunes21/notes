<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{   //auth routes
    public function login()
    {
        return view('login');
    }
    public function logout(){
        echo 'logout';
    }
    public function loginSubmit(Request $request){
        echo 'login submit '.$request->input('text_username');
        echo '<br>';
        echo  'password submit'.$request->input('text_password');
        echo '<br>';
        dd($request->all());

    }

}
