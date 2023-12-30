<?php

namespace App\Http\Controllers;

use App\Models\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('dashboard.dashboard');
    }

    public function profile(){
        
        return view('dashboard.profile');

    }

    public function update_profile(Request $request){

        $validator = Validator::make($request->all(), [
            
            'current_password'=>'required',
            'new_password'=>'required',
            'mobile_number'=>'required',
        ]); 
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
            
        }else{

            $current_password = md5($request->input('current_password'));
            $new_password = md5($request->input('new_password'));
            $mobile_number = $request->input('mobile_number');
         
            

            $auth = Auth::where('password', $current_password)->where('mobile_number',$mobile_number)->count();

            if($auth==1){

        

                $auth_update = Auth::where('mobile_number',$mobile_number)->first();
                $auth_update->password = $new_password;
                $auth_update->save();
                return redirect()->back()->with('success', 'New Password Updated Successfully');

            }else{
                return redirect()->back()->with('error', 'Invalid your Mobile or Password Number');
            }


        }

    }

    public function logout(){
        Session::flush();
        return redirect('/');
    }
}
