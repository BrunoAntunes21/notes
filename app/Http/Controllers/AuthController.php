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
        //form validation
        $request->validate(//rules
            [
            'text_username=>' => 'required|email',
            'text_password' => 'required|min:6|max:16'
            ],//error menssages,
        [
            'text_username.required'=>'Username is required',
            'text_username.email'=>'Username must be a valid email address',
            'text_password.required'=>'Password is required',
            'text_password.min'=>'Password must be at least 6 characters',
            'text_password.max'=>'Password must not exceed 16 characters'
        ]);
        //get user input
        $username=$request->input('text_username');
        $password=$request->input('text_password');

        echo "OK";
        echo '<br>';
        echo 'login submit '.$request->input('text_username');
        echo '<br>';
        echo  'password submit'.$request->input('text_password');
        echo '<br>';
        dd($request->all());

    }

}
