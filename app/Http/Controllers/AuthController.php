<?php

namespace App\Http\Controllers;

use App\Models\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function auth(){
        return view('auth.auth');

    }

    public function auth_post(Request $request){

        $validator = Validator::make($request->all(), [
            
            'mobile_number'=>'required',
            'password'=> 'required',
        ]); 

        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
            
        }else{
            $mobile_number = $request->input('mobile_number');
            $password = md5( $request->input('password') );

            $auth = Auth::where('mobile_number',$mobile_number)->where('password',$password)->count();

            if($auth == 1){
                Session::put('credential', 'authentication_success');
                Session::put('mobile_number', $mobile_number);
                return redirect('/dashboard')->with('success', 'Welcome to Admin !!');

            }else{
                return  redirect()->back()->with('error', 'Error your mobile number or password');

            }

            
            
            //$auth = NEW Auth();
            //$auth->mobile_number = $mobile_number;
            //$auth->password = $password;
            //$auth->save();

           

        }

    }
}
