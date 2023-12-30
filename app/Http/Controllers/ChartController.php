<?php

namespace App\Http\Controllers;

use App\Models\ChartChild;
use App\Models\ChartMain;
use App\Models\ChartParent;
use App\Models\PatronStatus;
use App\Models\TransactionArea;
use App\Models\TransactionMode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PDF;

class ChartController extends Controller
{
    
    public function account_summery(){
        $chart_parent = ChartParent::all();
        $chart_main = ChartMain::all();
        $chart_child = ChartChild::all();

        return view('chart-account.account-summery',compact('chart_parent','chart_main','chart_child'));
    }

    public function parent_account(){
        $chart_parent = ChartParent::all();
        return view('chart-account.parent-account',compact('chart_parent'));
    }

    public function parent_account_post(Request $request){
        $validator = Validator::make($request->all(), [
            
            'name'=>'required',
        ]); 
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
            
        }else{

            $name = $request->input('name');

            $chart_parent = New ChartParent();
            $chart_parent->name = $name;
            $chart_parent->save();
            return redirect()->back()->with('success','Data Inserted Successfully');
            
        }
    }

    public function main_account(){
        $chart_parent = ChartParent::all();
        $chart_main = ChartMain::all();
        return view('chart-account.main-account',compact('chart_parent','chart_main'));
    }

    public function main_account_post(Request $request){

        $validator = Validator::make($request->all(), [
            
            'name'=>'required',
            'parent_account'=> 'required',
        ]); 
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
            
        }else{

            $parent_account = $request->input('parent_account');
            $name = $request->input('name');

            $parent_account_data = ChartParent::where('id',$parent_account)->first();
            $parent_account_name = $parent_account_data->name;

            $chart_main = New ChartMain();
            $chart_main->parent_account = $parent_account;
            $chart_main->name = $name;
            $chart_main->parent_account_name = $parent_account_name;
            $chart_main->save();
           
            return redirect()->back()->with('success','Date Inserted Successfully');
            
        }


    }

    public function child_account(){
        $chart_parent = ChartParent::all();
        $chart_child = ChartChild::all();
        return view('chart-account.child-account',compact('chart_parent','chart_child'));
    }

    public function fetch_data(Request $request){

        $parent_account = $request->input('parent_account');
        $chart_main = ChartMain::where('parent_account', $parent_account)->get();
        return response()->json($chart_main);

    }

    public function child_account_post(Request $request){
        

        $validator = Validator::make($request->all(), [
            
            'name'=>'required',
            'parent_account'=> 'required',
            'main_account'=> 'required',
        ]); 
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
            
        }else{
            $name = $request->input('name');
            $parent_account = $request->input('parent_account');
            $main_account = $request->input('main_account');

            $parent_account_data = ChartParent::where('id',$parent_account)->first();
            $parent_account_name = $parent_account_data->name;

            $main_account_data = ChartMain::where('id',$main_account)->first();
            $main_account_name = $main_account_data->name;
            
            $chart_child = New ChartChild();
            $chart_child->name = $name;
            $chart_child->parent_account = $parent_account;
            $chart_child->main_account = $main_account;
            $chart_child->parent_account_name = $parent_account_name;
            $chart_child->main_account_name = $main_account_name;

            $chart_child->save();

            return redirect()->back()->with('success','Data Insert Successfully');

        }

    }


    public function transaction_mode(){
        $chart_child = ChartChild::all();
        $transaction_mode = TransactionMode::all();
        $patron_zone = PatronStatus::all();
        return view('chart-account.transaction-mode',compact('chart_child','transaction_mode', 'patron_zone'));

    }

    public function transaction_mode_post(Request $request){

        $validator = Validator::make($request->all(), [
            
            'company_name'=>'required',
            'child_account'=> 'required',
            'transaction_mode'=> 'required',
            'voucher_type' => 'required'
        ]); 
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
            
        }else{

            $company_name = $request->input('company_name');
            $child_account = $request->input('child_account');
            $transaction_mode = $request->input('transaction_mode');
            $voucher_type = $request->input('voucher_type');
            $patron_zone = $request->input('patron_zone');

            $chart_child = ChartChild::where('id',$child_account)->first();
            $child_account_name = $chart_child->name;

            $chart_area = New TransactionArea();
            $chart_area->company_name = $company_name;
            $chart_area->child_account = $child_account;
            $chart_area->transaction_mode = $transaction_mode;
            $chart_area->child_account_name = $child_account_name;
            $chart_area->voucher_type = $voucher_type;
            $chart_area->patron_status = $patron_zone;

            $chart_area->save();
            return redirect()->back()->with('success', 'New Record inserted Successfully');

        }

    }

    public function transaction_mode_view(){
        $transaction_area = TransactionArea::all();
        $child_account = ChartChild::all();
        $transaction_mode = TransactionMode::all();
        $patron_zone = PatronStatus::all();
        return view('chart-account.transaction-mode-view',compact('transaction_area','child_account','transaction_mode','patron_zone'));
    }

    public function transaction_mode_edit(){
        $transaction_area = TransactionArea::all();
        $child_account = ChartChild::all();
        $transaction_mode = TransactionMode::all();
        $patron_zone = PatronStatus::all();
        return view('chart-account.transaction-mode-edit',  compact('transaction_area','child_account','transaction_mode','patron_zone')  );
    }


    public function transaction_mode_edit_data($id){
        $transaction_area = TransactionArea::where('id', $id)->first();
        $company_name = $transaction_area->company_name;
        $child_account = $transaction_area->child_account;
        $transaction_mode = $transaction_area->transaction_mode;
        $patron_status = $transaction_area->patron_status;
        $child_account_name = $transaction_area->child_account_name;
        $voucher_type = $transaction_area->voucher_type;
        

        $chart_child = ChartChild::all();
        $transaction_mode_data = TransactionMode::all();
        $patron_zone = PatronStatus::all();

        return view('chart-account.transaction-mode-update',compact('id','company_name','child_account','transaction_mode','patron_status','child_account_name','voucher_type','chart_child','transaction_mode_data','patron_zone') );
    }

    public function transaction_mode_update(Request $request){

        $validator = Validator::make($request->all(), [
            
            'company_name'=>'required',
            'child_account'=> 'required',
            'transaction_mode'=> 'required',
            'voucher_type' => 'required'
        ]); 
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
            
        }else{
            $id = $request->input('id');
            $company_name = $request->input('company_name');
            $child_account = $request->input('child_account');
            $transaction_mode = $request->input('transaction_mode');
            $patron_status = $request->input('patron_zone');
            $voucher_type = $request->input('voucher_type');

            $transaction_area = TransactionArea::where('id',$id)->first();
            $transaction_area->company_name = $company_name;
            $transaction_area->child_account = $child_account;
            $transaction_area->transaction_mode = $transaction_mode;
            $transaction_area->patron_status = $patron_status;
            $transaction_area->voucher_type = $voucher_type;

            $transaction_area->save();
            return redirect('/chart-account/transaction-mode-edit')->with('success', 'New Record Updated Successfully');



        }

    }


    public function transaction_mode_delete($id){
        $transaction_area = TransactionArea::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Data Deleted Successfully');
    } 

    public function account_management(){
        $chart_child = ChartChild::all();
        return view('chart-account.account-management', compact('chart_child'));

    }

    public function account_management_post(Request $request){

        $validator = Validator::make($request->all(), [
            
            'account_id'=>'required',
            'section'=> 'required',
        ]); 
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
            
        }else{ 

            $account_id = $request->input('account_id');
            $section = $request->input('section');

            $chart_child = ChartChild::where('id',$account_id)->first();

            $chart_child->section = $section;
            $chart_child->save();
            return redirect()->back()->with('success', 'Account Updated Successfully');
        }


    }

    public function account_summery_pdf(){

        $chart_parent = ChartParent::all();
        $chart_main = ChartMain::all();
        $chart_child = ChartChild::all();

        $data = [
            'chart_parent' => $chart_parent,
            'chart_main' => $chart_main,
            'chart_child' => $chart_child,
        ];

        //return view('chart-account.pdf-account-summery', compact('chart_parent', 'chart_main', 'chart_child'));

         $pdf = PDF::loadView('chart-account.pdf-account-summery', $data);
         return $pdf->download('ChartAccount.pdf');

    }

}
