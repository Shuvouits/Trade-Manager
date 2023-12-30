<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Department;
use App\Models\HR;
use App\Models\HrRecord;
use App\Models\LoanReceive;
use App\Models\PatronCategory;
use App\Models\PatronDetails;
use App\Models\PatronStatus;
use App\Models\PayrollBreakup;
use App\Models\PayrollBreakupBasic;
use App\Models\Position;
use App\Models\Project;
use App\Models\ProjectDetails;
use App\Models\ProjectType;
use App\Models\Voucher;
use App\Models\VoucherCredit;
use App\Models\VoucherDebit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;



class InitialController extends Controller
{
    public function project(){
        $patron_status = PatronStatus::all();
       
        $patron_details = PatronDetails::where('patron_status',3)->get();
        return view('initial.project', compact('patron_status','patron_details') );
    }

    public function patron_category(){
        $patron_status = PatronStatus::all();
        return view('initial.patron-category',compact('patron_status'));
    }

    public function patron_status(Request $request){
        $validator = Validator::make($request->all(), [
            
            'company_name'=>'required',
            'status'=>'required',
        ]); 
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
            
        }else{
            $company_name = $request->input('company_name');
            $status = $request->input('status');

            $patron_status = New PatronStatus();
            $patron_status->company_name = $company_name;
            $patron_status->status = $status;
            $patron_status->save();

            return redirect()->back()->with('success', 'New Patron Status Inserted');

        }
    }

    public function patron_category_add(Request $request){
        $validator = Validator::make($request->all(), [
            
            'company_name'=>'required',
            'patron_status'=>'required',
            'patron_category'=>'required',
        ]); 
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
            
        }else{
            $company_name = $request->input('company_name');
            $patron_status = $request->input('patron_status');
            $patron_category_name = $request->input('patron_category');

            $patron_category = New PatronCategory();
            $patron_category->company_name = $company_name;
            $patron_category->patron_status = $patron_status;
            $patron_category->name = $patron_category_name;
            $patron_category->save();

            return redirect()->back()->with('success', 'New Patron Status Inserted');

        }
    }

    public function patron_status_view(){
        $patron_status = PatronStatus::all();
        $patron_category = PatronCategory::all();
        return view('initial.patron-status-view',compact('patron_status','patron_category'));
    }

    public function fetch_data(Request $request){

        $patron_status = $request->input('patron_status');
        $data = PatronCategory::where('patron_status', $patron_status)->get();
        return response()->json($data);

    }

    public function patron_details_post(Request $request){

        $validator = Validator::make($request->all(), [
            
            'company_name'=>'required',
            'patron_status'=>'required',
            'patron_category'=>'required',
            'patron_name'=>'required',
            'address_1'=>'required',
           
            'contact_number'=>'required',
            'date_introducing'=>'required',
            'transaction_limit'=>'required',
        ]); 
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
            
        }else{

            $company_name = $request->input('company_name');
            $patron_status = $request->input('patron_status');
            $patron_category = $request->input('patron_category');
            $patron_name= $request->input('patron_name');
            $address_1 = $request->input('address_1');
           
            $contact_number = $request->input('contact_number');
            $date_introducing = $request->input('date_introducing');
            $transaction_limit = $request->input('transaction_limit');

            $project_details = New PatronDetails();
            $project_details->company_name = $company_name;
            $project_details->patron_status = $patron_status;
            $project_details->patron_category = $patron_category;
            $project_details->patron_name = $patron_name;
            $project_details->address_1 = $address_1;
           
            $project_details->contact_number = $contact_number;
            $project_details->date_introducing = $date_introducing;
            $project_details->transaction_limit = $transaction_limit;

            $project_details->save();
            return redirect()->back()->with('success','Data Inserted Successfully');


        }

    }

    public function patron_details(Request $request){
        $patron_status = PatronStatus::all();
        return view('initial.patron-details',compact('patron_status'));
    }

    public function project_type(){
        //$patron_category = PatronCategory::where('patron_status','3')->get();
        $patron_details = PatronDetails::where('patron_status', '3')->get();
        return view('initial.project-type',compact('patron_details'));
    }

    public function project_type_post(Request $request){

        $validator = Validator::make($request->all(), [
            
            'company_name'=>'required',
            'project_type'=>'required',
            'patron_id'=>'required',
           
        ]); 
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
            
        }else{

            $company_name = $request->input('company_name');
            $project_type_name = $request->input('project_type');
            $patron_id = $request->input('patron_id');

            $project_type = New ProjectType();
            $project_type->name = $project_type_name;
            $project_type->patron_id = $patron_id;
            $project_type->company_name = $company_name;
            $project_type->save();

            return redirect()->back()->with('success','New Data Inserted');


        }

    }

    public function patron_details_view(){
        $patron_category = PatronCategory::all();
        $patron_details = PatronDetails::all();
        $patron_status = PatronStatus::all();
        return view('initial.patron-details-view',compact('patron_category','patron_details','patron_status'));

    }

    public function project_type_view(){

        $patron_details = PatronDetails::all();
        $project_type = ProjectType::all();
       
        return view('initial.project-type-view',compact('patron_details','project_type'));

    }

    public function api_project(Request $request){

        $project_owner = $request->input('project_owner');
        $data = ProjectType::where('patron_id', $project_owner)->get();
        return response()->json($data);

    }

    public function project_post(Request $request){

        $validator = Validator::make($request->all(), [
            
            'company_name'=>'required',
            'project_owner'=>'required',
            'project_type'=>'required',
            'date_start'=>'required',
            'date_complete'=>'required',
            'project_name'=>'required',
            'project_incharge'=>'required',
            'project_address'=>'required',
            'contact'=>'required',
            'project_referrence'=>'required',
            'project_value'=>'required',
        ]); 
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
            
        }else{

            $company_name = $request->input('company_name');
            $project_owner = $request->input('project_owner');
            $project_type = $request->input('project_type');
            $date_start = $request->input('date_start');
            $date_complete = $request->input('date_complete');
            $project_name = $request->input('project_name');
            $project_incharge = $request->input('project_incharge');
            $project_address = $request->input('project_address');
            $contact = $request->input('contact');
            $project_referrence = $request->input('project_referrence');
            $project_value = $request->input('project_value');


            $project = New Project();
            $project->company_name = $company_name;
            $project->project_owner = $project_owner;
            $project->project_type = $project_type;
            $project->date_start = $date_start;
            $project->date_complete = $date_complete;
            $project->project_name = $project_name;
            $project->project_incharge = $project_incharge;
            $project->project_address = $project_address;
            $project->contact = $contact;
            $project->project_referrence = $project_referrence;
            $project->project_value = $project_value;

            $project->save();

            return redirect()->back()->with('success','New Project Inserted');



        }

    }

    public function project_details_view(){
        $project = Project::all();
        $patron_category = PatronCategory::all();
        $project_type = ProjectType::all();
        $patron_details = PatronDetails::all();
        return view('initial.project-details-view', compact('project','patron_category','project_type','patron_details'));
    }

    public function bank(){
        return view('initial.bank');
    }

    public function bank_post(Request $request){

        $validator = Validator::make($request->all(), [
            
            'company_name'=>'required',
            'bank_name'=>'required',
            'date_opening'=>'required',
            'address'=>'required',
            'swift_code'=>'required',
            'account_type'=>'required',
            'account_number'=>'required',
           
        ]); 
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
            
        }else{

            $company_name = $request->input('company_name');
            $bank_name = $request->input('bank_name');
            $date_opening = $request->input('date_opening');
            $address = $request->input('address');
            $swift_code = $request->input('swift_code');
            $account_type = $request->input('account_type');
            $account_number = $request->input('account_number');

            $bank = New Bank();
            $bank->company_name = $company_name;
            $bank->bank_name = $bank_name;
            $bank->date_opening = $date_opening;
            $bank->address = $address;
            $bank->swift_code = $swift_code;
            $bank->account_type = $account_type;
            $bank->account_number = $account_number;

            $bank->save();
            return redirect()->back()->with('success', 'New Bank Record Inserted');


        }


    }

    public function bank_details_view(){
        $bank = Bank::all();
        return view('initial.bank-details-view', compact('bank'));
    }

    public function department_position(){
        $department = Department::all();
        return view('initial.department-position', compact('department'));

    }

    public function department_position_add(){
        return view('initial.department-position-add');
    }

    public function department_position_add_post(Request $request){

        $validator = Validator::make($request->all(), [
            
            'company_name'=>'required',
            'department_name'=>'required',
            
           
        ]); 
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
            
        }else{
            $company_name = $request->input('company_name');
            $department_name = $request->input('department_name');

            $department = New Department();
            $department->company_name = $company_name;
            $department->department = $department_name;
            $department->save();
            return redirect()->back()->with('success', 'New Department inserted');

        }
       
    }

    public function department_position_post(Request $request){

        $validator = Validator::make($request->all(), [
            
            'company_name'=>'required',
            'department'=>'required',
            'position'=>'required',
            'exclusive'=>'required',
            
           
        ]); 
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
            
        }else{
            $company_name = $request->input('company_name');
            $department = $request->input('department');
            $position_name = $request->input('position');
            $exclusive = $request->input('exclusive');

            $position = New Position();
            $position->company_name = $company_name;
            $position->department = $department;
            $position->position = $position_name;
            $position->exclusive = $exclusive;
            $position->save();
            return redirect()->back()->with('success', 'New Data inserted');

        }
       
    }

    public function department_position_view(){
        $position = Position::all();
        $department = Department::all();
        return view('initial.department-position-view', compact('position','department'));
    }

    public function human_resource(){
        $department = Department::all();
        return view('initial.human-resource', compact('department'));
    }


    public function human_resource_post(Request $request){

        $validator = Validator::make($request->all(), [
            
            'company_name'=>'required',
            'name'=>'required',
            'birth_date'=>'required',
            'parent_name'=>'required',
            'joining_date'=>'required',
            'permanent_address'=>'required',
            'contact_address'=>'required',
            'contact_number'=>'required',
            'qualification'=>'required',
            'position'=>'required',
            'joining_point'=>'required'
            
           
        ]); 
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
            
        }else{

            $company_name = $request->input('company_name');
            $name = $request->input('name');
            $birth_date = $request->input('birth_date');
            $parent_name = $request->input('parent_name');
            $joining_date = $request->input('joining_date');
            $permanent_address = $request->input('permanent_address');
            $contact_address = $request->input('contact_address');
            $contact_number = $request->input('contact_number');
            $qualification = $request->input('qualification');
            $position = $request->input('position');
            $joining_point = $request->input('joining_point');

            //auto id generator
            $year = date('Y');
            $hr_data = HR::whereYear('created_at',$year)->orderBy('hr_id','DESC')->first();
            if($hr_data != ''){
                $hr_id = $hr_data->hr_id + 1;
                

            }else{
                $y = date('y');
                $hr_id = $y."001";
                

            }
           
        
             //End auto id generator
           
            
      


            $hr = New HR();
            $hr->company_name = $company_name;
            $hr->name = $name;
            $hr->birth_date = $birth_date;
            $hr->parent_name = $parent_name;
            $hr->joining_date = $joining_date;
            $hr->permanent_address = $permanent_address;
            $hr->contact_address = $contact_address;
            $hr->contact_number = $contact_number;
            $hr->qualification = $qualification;
            $hr->position = $position;
            $hr->joining_point = $joining_point;
            $hr->hr_id = $hr_id;
            $hr->status = 'on';

            $hr->save();
            return redirect()->back()->with('success','New Record Insert Successfully');
           
        }

       
    }  

  


    public function api_hr(Request $request){
        $joining_point = $request->input('joining_point');
        $data = Position::where('department', $joining_point)->get();

        return response()->json($data);

    }


    public function human_resource_view(){
        $hr = HR::all();
        $department = Department::all();
        $position = Position::all();
       
        return view('initial.human-resource-view', compact('hr','department','position'));
    }


    public function human_resource_view_edit($id){
   
        $department = Department::all();
        $position = Position::all();
        $update_data = HR::where('id', $id)->first();
       // return $update_data;

        $name = $update_data->name;
        $birth_date = $update_data->birth_date;
        $parent_name = $update_data->parent_name;
        $permanent_address = $update_data->permanent_address;
     
        $contact_address = $update_data->contact_address;
        $contact_number = $update_data->contact_number;
        $qualification = $update_data->qualification;
        $update_position = $update_data->position;
        $joining_point = $update_data->joining_point;
        $hr_id = $update_data->hr_id;
        $joining_date = $update_data->joining_date;
        $position = $update_data->position;
    

        $all_department_data = Department::where('id', $joining_point)->first();
        $joining_point_name = $all_department_data->department;

        

        $all_position_data = Position::where('id', $position)->first();
        $position_name = $all_position_data->position;
       
        
        //return $name;
     
        return view('initial.human-resource-edit', compact('id','department','joining_date','position', 'name','birth_date','parent_name','permanent_address','contact_address','contact_number','qualification','update_position','joining_point','hr_id','joining_point_name','position_name'));
    }

    public function human_resource_view_delete($id){
        
        $delete_data = HR::where('id',$id)->delete();
        return redirect()->back()->with('success', 'HR deleted successfully');

    }

    public function human_resource_update(Request $request){

        $validator = Validator::make($request->all(), [
            
            'company_name'=>'required',
            'name'=>'required',
            'birth_date'=>'required',
            'parent_name'=>'required',
            'joining_date'=>'required',
            'permanent_address'=>'required',
            'contact_address'=>'required',
            'contact_number'=>'required',
            'qualification'=>'required',
            'position'=>'required',
            'joining_point'=>'required'
            
           
        ]); 

        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
            
        }else{

            $id = $request->input('id');
           
            $company_name = $request->input('company_name');
            $name = $request->input('name');
            $birth_date = $request->input('birth_date');
            $parent_name = $request->input('parent_name');
            $joining_date = $request->input('joining_date');
            $permanent_address = $request->input('permanent_address');
            $contact_address = $request->input('contact_address');
            $contact_number = $request->input('contact_number');
            $qualification = $request->input('qualification');
            $position = $request->input('position');
            $joining_point = $request->input('joining_point');

            $update_hr = HR::where('id', $id)->first();
            
            $update_hr->name = $name;
            $update_hr->birth_date = $birth_date;
            $update_hr->parent_name = $parent_name;
            $update_hr->joining_date = $joining_date;
            $update_hr->permanent_address = $permanent_address;
            $update_hr->contact_address = $contact_address;
            $update_hr->contact_number = $contact_number;
            $update_hr->qualification = $qualification;
            $update_hr->position = $position;
            $update_hr->joining_point = $joining_point;

            $update_hr->save();
            return redirect('/initial/human-resource-view')->with('success','New Record Updated Successfully');
        }
        
    }

    public function payroll_breakup_add(){
        $department = Department::all();
        return view('initial.payroll-breakup-add',compact('department'));
    }


    public function api_payroll_breakup(Request $request){
        $department = $request->input('department');
        $data = HR::where('joining_point', $department)->get();
        return response()->json($data);
    }

    public function payroll_breakup_basic_post(Request $request){

        $validator = Validator::make($request->all(), [
            
            'company_name'=>'required',
            'department'=>'required',
            'hr'=>'required',
            'date'=>'required',
            'basic'=>'required',
            'house_rent'=>'required',
            'medical_allowance'=>'required',
            'festival_bonus'=>'required',
           
        ]); 
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
            
        }else{

            $company_name = $request->input('company_name');
            $department = $request->input('department');
            $hr = $request->input('hr');
            $date = $request->input('date');
            $basic = $request->input('basic');
            $house_rent = $request->input('house_rent');
            $medical_allowance = $request->input('medical_allowance');
            $festival_bonus = $request->input('festival_bonus');
          

            $payroll_breakup_basic = New PayrollBreakupBasic();
            $payroll_breakup_basic->company_name = $company_name;
            $payroll_breakup_basic->department = $department;
            $payroll_breakup_basic->hr = $hr;
            $payroll_breakup_basic->date = $date;
            $payroll_breakup_basic->basic = $basic;
            $payroll_breakup_basic->house_rent = $house_rent;
            $payroll_breakup_basic->medical_allowance = $medical_allowance;
            $payroll_breakup_basic->festival_bonus = $festival_bonus;
            $payroll_breakup_basic->status = 'on';
           
            $payroll_breakup_basic->save();
            return redirect()->back()->with('success', 'New Payroll Record Inserted');

        }

    }  

    public function payroll_breakup_basic_delete(Request $request){
        $id = $request->input('id');

        $payroll_breakup_basic_data_delete = PayrollBreakupBasic::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Payroll Data Deleted Successfully');
        
    }

    public function payroll_breakup_basic(){
        $department = Department::all();
        return view('initial.payroll-breakup-basic',compact('department'));
    }

    public function payroll_breakup_view(){
        $department = Department::all();
        $payroll_breakup_basic = PayrollBreakupBasic::all();
        $hr = HR::all();
        $position = Position::all();
        return view('initial.payroll-breakup-view',compact('department','payroll_breakup_basic','hr','position'));
    }

    public function payroll_breakup_add_post(Request $request){

        $validator = Validator::make($request->all(), [
            
            'company_name'=>'required',
            'department'=>'required',
            'hr'=>'required',
            'over_time'=>'required',
            'incentive_bonus'=>'required',
            'transport'=>'required',
            'mobile_bill'=>'required',
           
           
        ]); 
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
            
        }else{

            $company_name = $request->input('company_name');
            $department = $request->input('department');
            $hr = $request->input('hr');
            $over_time = $request->input('over_time');
            $incentive_bonus = $request->input('incentive_bonus');
            $transport = $request->input('transport');
            $mobile_bill = $request->input('mobile_bill');

            $payroll_breakup_basic = PayrollBreakupBasic::where('hr', $hr)->first();

            $payroll_breakup_basic->over_time_rate = $over_time;
            $payroll_breakup_basic->incentive_bonus = $incentive_bonus;
            $payroll_breakup_basic->transport = $transport;
            $payroll_breakup_basic->mobile_bill = $mobile_bill;

            $payroll_breakup_basic->save();
            return redirect()->back()->with('success', 'Payroll Record Inserted Successfully');


        }

    }

    public function payroll_breakup_deduction(){

        $department = Department::all();
        return view('initial.payroll-breakup-deduction',compact('department'));
    }
    
    public function payroll_breakup_deduction_post(Request $request){

        $validator = Validator::make($request->all(), [
            
            'company_name'=>'required',
            'department'=>'required',
            'hr'=>'required',
            'loan_limit'=>'required',
            'loan_adjust'=>'required',
            'provident_fund'=>'required',
            'insurance'=>'required',
            'income_tax'=>'required',
            'comphensation'=>'required',
            'date' => 'required'
           
        ]); 
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
            
        }else{

            $hr = $request->input('hr');
            $department = $request->input('department');

            $loan_limit = $request->input('loan_limit');
            $loan_adjust = $request->input('loan_adjust');
            
            $provident_fund = $request->input('provident_fund');
            $insurance = $request->input('insurance');
            $income_tax = $request->input('income_tax');
            $comphensation = $request->input('comphensation');
           

            $date = date('Y-m-d', strtotime($request->input('date')));


            $payroll_breakup_basic = PayrollBreakupBasic::where('hr',$hr)->first();
            $payroll_breakup_basic->loan_limit = $loan_limit;
            $payroll_breakup_basic->loan_adjust = $loan_adjust;
            $payroll_breakup_basic->current_loan = $loan_limit;
            $payroll_breakup_basic->provident_fund = $provident_fund;
            $payroll_breakup_basic->insurance = $insurance;
            $payroll_breakup_basic->income_tax = $income_tax;
            $payroll_breakup_basic->comphensation = $comphensation;
            $payroll_breakup_basic->save();


            // view print hr account ledger
            $hr_record = New HrRecord();
            $hr_record->hr = $hr;
            $hr_record->date = $date;
            $hr_record->p_loan = $loan_limit;
            $hr_record->save();

            return redirect()->back()->with('success', 'Payroll Deduction Record Inserted');



        }

    }

    public function human_resource_status_ajax(Request $request){

       $hr = $request->input('hr');

       //update Payroll Status
       $payroll_breakup_basic = PayrollBreakupBasic::where('hr',$hr)->first();
       $payroll_breakup_basic_status = $payroll_breakup_basic->status;

       if($payroll_breakup_basic_status == '' || $payroll_breakup_basic_status == 'on'){
        $payroll_breakup_basic->status = 'off';
        $payroll_breakup_basic->save();
       }else{
        $payroll_breakup_basic->status = 'on';
        $payroll_breakup_basic->save();
       }



       //update HR status
       $hr_data = HR::where('id',$hr)->first();
       $status = $hr_data->status;
 

       if($status == '' || $status == 'on'){
        $hr_data->status = 'off';
        $hr_data->save();
       }else{
        $hr_data->status = 'on';
        $hr_data->save();
       }

       

    }

    public function edit_payroll_breakup_basic(Request $request){
        $validator = Validator::make($request->all(), [
            
            'name'=>'required',
            'department'=>'required',
            'hr_id'=>'required',
            'basic'=>'required',
            'house_rent'=>'required',
            'medical_allowance'=>'required',
            'festival_bonus'=>'required',
            'mobile_bill'=>'required',
            'advance_salary'=>'required',
            'loan_limit'=>'required',
            'loan_adjust'=>'required',
            'current_loan'=>'required',
            'comphensation'=>'required',
           
        ]); 
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
            
        }else{
            $name = $request->input('name');
            $department = $request->input('department');
          
            $hr_id = $request->input('hr_id');
            $hr = $request->input('hr');
            $basic = $request->input('basic');
            $house_rent = $request->input('house_rent');
            $medical_allowance = $request->input('medical_allowance');
            $festival_bonus = $request->input('festival_bonus');
            $mobile_bill = $request->input('mobile_bill');
            $advance_salary = $request->input('advance_salary');
            $loan_limit = $request->input('loan_limit');
            $loan_adjust = $request->input('loan_adjust');
            $current_loan = $request->input('current_loan');
            $comphensation = $request->input('comphensation');

            //update process

            $hr_data = HR::where('hr_id',$hr_id)->first();
       
            $hr_data->name = $name;
            $hr_data->save();

            $payroll_breakup_basic = PayrollBreakupBasic::where('hr',$hr)->first();
           
            $payroll_breakup_basic->department = $department;
            $payroll_breakup_basic->basic = $basic;
            $payroll_breakup_basic->house_rent = $house_rent;
            $payroll_breakup_basic->medical_allowance = $medical_allowance;
            $payroll_breakup_basic->festival_bonus = $festival_bonus;
            $payroll_breakup_basic->mobile_bill = $mobile_bill;
            $payroll_breakup_basic->advance_salary = $advance_salary;
            $payroll_breakup_basic->loan_limit = $loan_limit;
            $payroll_breakup_basic->loan_adjust = $loan_adjust;
            $payroll_breakup_basic->current_loan = $current_loan;
            $payroll_breakup_basic->comphensation = $comphensation;
            $payroll_breakup_basic->save();
            return redirect()->back()->with('success','Record Updated Successfully');

        }

    } 

    public function patron_details_view_delete($id){
        $delete_data = PatronDetails::where('id',$id)->delete();
        return redirect()->back()->with('success','Patron Deleted Successfully');

    }

   

   

}
