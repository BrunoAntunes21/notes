<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AuthController extends Controller
{   //auth routes
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request){
        //form validation
        $request->validate(//rules
            [
            'text_username' => 'required|email',
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



        //check if user exists in the database
        $user=User::where('username',$username)->where('deleted_at',NULL)->first();
        if(!$user){
            return redirect()
            ->back()
            ->withInput()
            ->withErrors(['login_error' => 'User Name or password is incorrect']);
        }//check is password is correct
        if (!Hash::check($password, $user->password)) {
    return redirect()
        ->back()
        ->withInput()
        ->withErrors(['login_error' => 'User Name or password is incorrect']);


}
//update last login
        $user->last_login = Carbon::now();
        $user->save();

            session(['user' =>['id'=>$user->id, 'username' => $user->username]]);

        echo 'login successful';


    }
    public function logout(){
        session()->forget('user');
        return redirect('/login');
    }

}
