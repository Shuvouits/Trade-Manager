<?php

namespace App\Http\Controllers;

use App\Models\AdvancePayroll;
use App\Models\ChartChild;
use App\Models\Department;
use App\Models\HR;
use App\Models\HrRecord;
use App\Models\JobRecord;
use App\Models\JobRecordExtra;
use App\Models\LoanReceive;
use App\Models\Month;
use App\Models\PayrollBreakupBasic;
use App\Models\PayrollDistribution;
use App\Models\PayrollPreparation;
use App\Models\Position;
use App\Models\Voucher;
use App\Models\VoucherCredit;
use App\Models\VoucherDebit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\New_;

class PayrollController extends Controller
{
    public function job_record()
    {
        $month = Month::all();
        $hr = HR::where('status','on')->get();
        return view('payroll.job-record', compact('month', 'hr'));
    }

    public function payroll_preparation()
    {
        $month = Month::all();
        return view('payroll.payroll-preparation', compact('month'));
    }

    public function job_record_post(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'company_name' => 'required',
            'month' => 'required',
            'date' => 'required',
            'hr' => 'required',
            'absent' => 'required',
            'work_day' => 'required',
            'other_benifit' => 'required',
            'other_deduction' => 'required',
            'incentive' => 'required',
            'over_time' => 'required'


        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }else{

            $company_name = $request->input('company_name');
            $month = $request->input('month');
            $date = date('Y-m-d', strtotime($request->input('date')));
            $hr = $request->input('hr');
            $absent = $request->input('absent');
            $work_day = $request->input('work_day');
            $other_benifit = $request->input('other_benifit');
            $other_deduction = $request->input('other_deduction');
            $incentive = $request->input('incentive');
            $over_time = $request->input('over_time');
          

            $job_record_extra = New JobRecordExtra();
            $job_record_extra->month = $month;
            $job_record_extra->date = $date;
            $job_record_extra->hr = $hr;
            $job_record_extra->absent = $absent;
            $job_record_extra->work_day = $work_day;
            $job_record_extra->other_benifit = $other_benifit;
            $job_record_extra->other_deduction = $other_deduction;
            $job_record_extra->incentive = $incentive;
            $job_record_extra->overtime = $over_time;
            $job_record_extra->save();

            return redirect()->back()->with('success', 'New Record Inserted Successfully');

        } 
    }


    public function job_record_history()
    {
        $job_record_extra = JobRecordExtra::all();
        $hr = HR::all();
        $month = Month::all();
        return view('payroll.job-record-history', compact('job_record_extra','hr','month'));
    }

    public function payroll_preparation_post(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'company_name' => 'required',
            'status' => 'required',
            'month' => 'required',
            'date' => 'required',

        ]);


        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $company_name = $request->input('company_name');
            $p_status = $request->input('status');
            $month = $request->input('month');
            $date = date('Y-m-d', strtotime($request->input('date')));

            //counting Start
            $payroll_breakup_basic_count = PayrollBreakupBasic::count();
            $hr_count = HR::count();
            

            if($payroll_breakup_basic_count != $hr_count){
                return redirect()->back()->with('error','Please Confirm Employee Payroll Basic');
            }

            //counting End
        

            //Advance salary journal
            $sum_advance_salary = PayrollBreakupBasic::sum('advance_salary');
            if ($sum_advance_salary > 0) {
                //journal creation of advance amount
                $company_name = "XPERT SEO SERVICE";
                $voucher_type = 1;
                $date = $date;

                $account_id = 111;
                $account_name = 'Advance Payroll & Wages';
                $sub_account_id = 35;
                $sub_account_name = 'STAFF';
                $additional_account = 115;
                $additional_account_name = "Payroll & Wages Payable";

                $voucher = new Voucher();
                $voucher->company_name = $company_name;
                $voucher->voucher_type = $voucher_type;
                $voucher->date = $date;

                $voucher->account_id = $account_id;
                $voucher->account_name = $account_name;
                $voucher->sub_account_id = $sub_account_id;
                $voucher->sub_account_name = $sub_account_name;
                $voucher->additional_account = $additional_account;
                $voucher->additional_account_name = $additional_account_name;
                $voucher->save();

                $voucher_data = Voucher::orderBy('id','DESC')->first();
                $voucher_id = $voucher_data->id;

                //debit journal

                $voucher_debit = new VoucherDebit();
                $voucher_debit->voucher_id = $voucher_id;
                $voucher_debit->amount = $sum_advance_salary;
                $voucher_debit->voucher_type = $voucher_type;
                $voucher_debit->additional_account = $additional_account;
                $voucher_debit->sub_account_id = $sub_account_id;
                $voucher_debit->date = $date;
                $voucher_debit->save();

                //credit journal

                $voucher_credit = new VoucherCredit();
                $voucher_credit->voucher_id = $voucher_id;
                $voucher_credit->amount = $sum_advance_salary;
                $voucher_credit->voucher_type = $voucher_type;
                $voucher_credit->account_id = $account_id;
                $voucher_credit->sub_account_id = $sub_account_id;
                $voucher_credit->date = $date;
                $voucher_credit->save();
            }
            //End Advance salary journal
            
            //start hr loan journal
            $sum_hr_loan = PayrollBreakupBasic::sum('loan_adjust');
           
            if ($sum_hr_loan > 0) {

                //journal start
                $company_name = "XPERT SEO SERVICE";
                $voucher_type = 0;
                $date = $date;

                $account_id = 112;
                $account_name = 'Loan Receivable-HR';
                $sub_account_id = 35;
                $sub_account_name = 'STAFF';
                $additional_account = 115;
                $additional_account_name = "Payroll & Wages Payable";

                $voucher = new Voucher();
                $voucher->company_name = $company_name;
                $voucher->voucher_type = $voucher_type;
                $voucher->date = $date;

                $voucher->account_id = $account_id;
                $voucher->account_name = $account_name;
                $voucher->sub_account_id = $sub_account_id;
                $voucher->sub_account_name = $sub_account_name;
                $voucher->additional_account = $additional_account;
                $voucher->additional_account_name = $additional_account_name;

                $voucher->save();

                $voucher_data = Voucher::orderBy('id','DESC')->first();
                $voucher_id = $voucher_data->id;

                //debit journal

                $voucher_debit = new VoucherDebit();
                $voucher_debit->voucher_id = $voucher_id;
                $voucher_debit->amount = $sum_hr_loan;
                $voucher_debit->voucher_type = $voucher_type;
                $voucher_debit->additional_account = $additional_account;
                $voucher_debit->sub_account_id = $sub_account_id;
                $voucher_debit->date = $date;
                $voucher_debit->save();

                //credit journal

                $voucher_credit = new VoucherCredit();
                $voucher_credit->voucher_id = $voucher_id;
                $voucher_credit->amount = $sum_hr_loan;
                $voucher_credit->voucher_type = $voucher_type;
                $voucher_credit->account_id = $account_id;
                $voucher_credit->sub_account_id = $sub_account_id;
                $voucher_credit->date = $date;
                $voucher_credit->save();
            }
             //End hr loan journal
            
            $hr_count = HR::where('status','on')->count();
           
           
            
            for ($i = 0; $i < $hr_count; $i++) {
                $hr = HR::where('status','on')->get();
             
                $hr_id = $hr[$i]->id;

                //Advance Payroll Part
                $advance_payroll_count = PayrollBreakupBasic::where('hr', $hr_id)->sum('advance_salary');
                
               
                if ($advance_payroll_count > 1) {
                    $advance_amount = PayrollBreakupBasic::where('hr', $hr_id)->sum('advance_salary');
                    
                   
                    //initiate advance salary =0;
                    $payroll_breakup_basic_advance_salary = PayrollBreakupBasic::where('hr', $hr_id)->first();
                    $payroll_breakup_basic_advance_salary->advance_salary = 0;
                    $payroll_breakup_basic_advance_salary->save();
                } else {
                    $advance_amount = 0;
                }

                //End Advance Payroll Part

                //update loan reducing
                $payroll_breakup_basic_loan_update = PayrollBreakupBasic::where('hr', $hr_id)->first();
                $adjust_loan = $payroll_breakup_basic_loan_update->loan_adjust;
                $current_loan = $payroll_breakup_basic_loan_update->current_loan;

                if ($current_loan > 0) {

                   
                    //journal End
                    $current_loan = $current_loan - $adjust_loan;
                    $payroll_breakup_basic_loan_update->current_loan = $current_loan;
                    $payroll_breakup_basic_loan_update->save();
                } else if ($current_loan == 0) {
                    $payroll_breakup_basic_loan_update->loan_limit = 0;
                    $payroll_breakup_basic_loan_update->loan_adjust = 0;
                    $payroll_breakup_basic_loan_update->save();
                }
                //End update loan reducing



                $payroll_breakup_basic = PayrollBreakupBasic::where('hr', $hr_id)->first();
                
                
                //purpose for the basic payroll setup
                $basic_payroll = PayrollBreakupBasic::where('hr',$hr_id)->first();

                if ($basic_payroll == '') {
                    return redirect()->back()->with('error', 'Please Add the Basic Payroll of HR');
                }

                 //End of purpose for the basic payroll setup

                $basic = $payroll_breakup_basic->basic;
                $house_rent = $payroll_breakup_basic->house_rent;
                $medical_allowance = $payroll_breakup_basic->medical_allowance;
                $transport_allowance = $payroll_breakup_basic->transport;
                //$festival_bonus = $payroll_breakup_basic->festival_bonus;
                $mobile = $payroll_breakup_basic->mobile_bill;
                $advance = $payroll_breakup_basic->loan_limit;
                $comphensation = $payroll_breakup_basic->comphensation;
                $loan_adjust = $payroll_breakup_basic->loan_adjust;
                $provident_fund = $payroll_breakup_basic->provident_fund;
                $insurance = $payroll_breakup_basic->insurance;
                $income_tax = $payroll_breakup_basic->income_tax;

                //data pull job record extra
                $job_record_extra_count = JobRecordExtra::where('date', $date)->where('month', $month)->where('hr', $hr_id)->count();

                if ($job_record_extra_count > 0) {

                    $job_record_extra = JobRecordExtra::where('date', $date)->where('month', $month)->where('hr', $hr_id)->first();
                    $absent = $job_record_extra->absent;
                    $work_day = $job_record_extra->work_day;
                    $over_time = $job_record_extra->overtime;
                    $incentive = $job_record_extra->incentive;
                    $other_benifit = $job_record_extra->other_benifit;
                    $other_deduction = $job_record_extra->other_deduction;

                    $gross_salary = $basic + $house_rent + $medical_allowance + $transport_allowance + $over_time + $incentive + $mobile + $other_benifit;
                    $due_net_payroll = $gross_salary - ($comphensation + $loan_adjust + $provident_fund + $income_tax + $other_deduction) - $advance_amount;
                }else{

                    $gross_salary = $basic + $house_rent + $medical_allowance + $transport_allowance + $mobile;
                    $due_net_payroll = $gross_salary - ($comphensation + $loan_adjust + $provident_fund + $income_tax) - $advance_amount;

                 

                }
                
                //End data pull job record extra


                

                //Name finding pull

                $hr_data = HR::where('id', $hr_id)->first();
                
                $department = $hr_data->joining_point;
                $position = $hr_data->position;

                $department_data = Department::where('id', $department)->first();
                $department_name = $department_data->department;


                $position_data = Position::where('id', $position)->first();
                $position_name = $position_data->position;

                //End Name finding pull


                $job_record = new JobRecord();
                $job_record->company_name = $company_name;
                $job_record->month = $month;
                $job_record->date = $date;
                $job_record->hr = $hr_id;

                if ($job_record_extra_count > 0) {
                    $job_record->absent = $absent;
                    $job_record->work_day = $work_day;
                    $job_record->other_benifit = $other_benifit;
                    $job_record->other_deduction = $other_deduction;
                    $job_record->incentive = $incentive;
                    $job_record->over_time = $over_time;
                }


                $job_record->basic = $basic;
                $job_record->house_rent = $house_rent;
                $job_record->medical_allowance = $medical_allowance;
                $job_record->transport_allowance = $transport_allowance;
                //$job_record->festival_bonus = $festival_bonus;
                $job_record->mobile = $mobile;
                $job_record->advance = $advance;
                $job_record->comphensation = $comphensation;
                $job_record->loan_adjust = $loan_adjust;
                $job_record->provident_fund = $provident_fund;
                $job_record->insurance = $insurance;
                $job_record->income_tax = $income_tax;
                $job_record->department_name = $department_name;
                $job_record->position_name = $position_name;
                $job_record->gross_salary = $gross_salary;

                //advance loan cutting
                $job_record->due_net_payroll = $due_net_payroll;

                //advance payroll
                $job_record->advance_salary =  $advance_amount;
                $job_record->save();
            }
            //End of job record





            //hr account for view print
            

            if ($p_status == 1) {
               
               
                
                $job_record_count = JobRecord::where('date', $date)->count();

                for ($i = 0; $i < $job_record_count; $i++) {
                    $job_record = JobRecord::where('date', $date)->get();
                    $hr = $job_record[$i]->hr;
                    $gross_salary = $job_record[$i]->gross_salary;
                    $advance_salary = $job_record[$i]->advance_salary;
                    $loan_advance = $job_record[$i]->advance;
                    $loan_adjust = $job_record[$i]->loan_adjust;

                    //purpose advance salary
                    if ($advance_salary > 1) {
                        $hr_record = new HrRecord();
                        $hr_record->hr = $hr;
                        $hr_record->date = $date;
                        $hr_record->a_advance = $advance_salary;
                        $hr_record->save();
                    }

                    //purpose of hr loan
                    if ($loan_advance > 1) {
                        $hr_record = new HrRecord();
                        $hr_record->hr = $hr;
                        $hr_record->date = $date;
                        $hr_record->a_loan = $loan_adjust;
                        $hr_record->save();
                    }

                    //basic payroll
                    $hr_record = new HrRecord();
                    $hr_record->hr = $hr;
                    $hr_record->date = $date;
                    $hr_record->p_payroll = $gross_salary;
                    $hr_record->save();
                }
            }
            //End hr account for view print



            $payroll_preparation = new PayrollPreparation();
            $payroll_preparation->company_name = $company_name;
            $payroll_preparation->status = $p_status;
            $payroll_preparation->month = $month;
            $payroll_preparation->date = $date;
            $payroll_preparation->save();

            $job_record_count = JobRecord::where('date', $date)->count();

            if ($p_status == 2) {

                for ($i = 0; $i < $job_record_count; $i++) {
                    $job_record = JobRecord::where('date', $date)->get();
                    $hr =  $job_record[$i]->hr;
                    $advance_salary = $job_record[$i]->advance_salary;

                    $loan_advance = $job_record[$i]->advance;
                    $loan_adjust = $job_record[$i]->loan_adjust;

                    $payroll_breakup_basic = PayrollBreakupBasic::where('hr', $hr)->first();
                    $festival_bonus = $payroll_breakup_basic->festival_bonus;



                    $job_record_data = JobRecord::where('hr', $hr)->where('date', $date)->first();

                    $gross_salary = $job_record_data->gross_salary;
                    $due_net_payroll = $job_record_data->due_net_payroll;


                    $update_gross = $festival_bonus + $gross_salary;
                    $update_due = $festival_bonus + $due_net_payroll;

                    $job_record_data->festival_bonus = $festival_bonus;
                    $job_record_data->gross_salary = $update_gross;
                    $job_record_data->due_net_payroll = $update_due;

                    $job_record_data->save();


                    //purpose advance salary
                    if ($advance_salary > 1) {
                        $hr_record = new HrRecord();
                        $hr_record->hr = $hr;
                        $hr_record->date = $date;
                        $hr_record->a_advance = $advance_salary;
                        $hr_record->save();
                    }

                    //purpose of hr loan
                    if ($loan_advance > 1) {
                        $hr_record = new HrRecord();
                        $hr_record->hr = $hr;
                        $hr_record->date = $date;
                        $hr_record->a_loan = $loan_adjust;
                        $hr_record->save();
                    }


                    //hr account for view print

                    $hr_record = new HrRecord();
                    $hr_record->hr = $hr;
                    $hr_record->date = $date;
                    $hr_record->p_payroll =  $update_gross;
                    $hr_record->save();

                    //End hr account for view print
                }
            }


            //get total amount in job record;
            $amount = JobRecord::where('date', $date)->sum('due_net_payroll');

            //implement voucher 
            $voucher_type = 1;
            $date = $date;
            $referrence = $date;

            $account_id = 79;
            $account_name = "Payroll";
            $sub_account_id = 35;
            $sub_account_name = "STAFF";
            $additional_account = 115;
            $additional_account_name = "Payroll & Wages Payable";

            $voucher = new Voucher();
            $voucher->voucher_type = $voucher_type;
            $voucher->date = $date;
            $voucher->referrence = $referrence;
            $voucher->account_id = $account_id;
            $voucher->account_name = $account_name;
            $voucher->sub_account_id = $sub_account_id;
            $voucher->sub_account_name = $sub_account_name;
            $voucher->additional_account = $additional_account;
            $voucher->additional_account_name = $additional_account_name;
            $voucher->save();

            
            $voucher_data = Voucher::orderBy('id','DESC')->first();
            $voucher_id = $voucher_data->id;


            //implement voucher debit
            $voucher_debit = new VoucherDebit();
            $voucher_debit->voucher_id = $voucher_id;
            $voucher_debit->amount = $amount;
            $voucher_debit->voucher_type = $voucher_type;
            $voucher_debit->account_id = $account_id;
            $voucher_debit->date = $date;
            $voucher_debit->save();

            //implement voucher credit
            $voucher_credit = new VoucherCredit();
            $voucher_credit->voucher_id = $voucher_id;
            $voucher_credit->amount = $amount;
            $voucher_credit->voucher_type = $voucher_type;
            $voucher_credit->additional_account = $additional_account;
            $voucher_credit->sub_account_id = $sub_account_id;
            $voucher_credit->date = $date;
            $voucher_credit->save();

            return redirect()->back()->with('success', 'Payroll Record Inserted Successfully');
        }
    }

    public function wage_distribution()
    {
        $chart_child = ChartChild::all();
        $hr = HR::where('status','on')->get();
        return view('payroll.wage-distribution', compact('chart_child', 'hr'));
    }





    public function payroll_preparation_history()
    {
        $job_record = JobRecord::all();
        $hr = HR::all();
        $month = Month::all();
        return view('payroll.payroll-preparation-history', compact('job_record', 'hr', 'month'));
    }

    public function payroll_distribution(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'company_name' => 'required',
            'status' => 'required',
            'date' => 'required',
            'referrence' => 'required',
            'account_id' => 'required',
            'hr' => 'required',
            'amount' => 'required',

        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $company_name = $request->input('company_name');
            $status = $request->input('status');

            $date_data = $request->input('date');
             
            //session purpose
            
            session()->put('payroll_session_date_data',$date_data);
            //return session()->get('session_date_data');

            //end

            $date = date('Y-m-d', strtotime($request->input('date')));
           
          

            $referrence_data = $request->input('referrence');
            //session purpose
            
            session()->put('payroll_session_referrence_data',$referrence_data);
            //return session()->get('session_date_data');

            //end


            $referrence = $request->input('referrence');
            $account_id = $request->input('account_id');

            $hr = $request->input('hr');
            $amount = $request->input('amount');

            $chart_child = ChartChild::where('id', $account_id)->first();
            $account_name = $chart_child->name;




            //Advance Payroll & Wages

            if ($account_id == 111) {

                $company_name = "XPERT SEO SERVICE";
                $voucher_type = 1;
                $transaction_mode = 1;
                $transaction_mode_name = 'Cash';
                $account_id = 111;
                $account_name = 'Advance Payroll & Wages';
                $sub_account_id = 35;
                $sub_account_name = 'STAFF';




                //Advance salary data update
                $payroll_breakup_basic = PayrollBreakupBasic::where('hr', $hr)->first();
                $payroll_breakup_basic->advance_salary = $amount;
                $payroll_breakup_basic->save();



                //voucher Entry

                $voucher = new Voucher();
                $voucher->company_name = $company_name;
                $voucher->voucher_type = $voucher_type;
                $voucher->date = $date;
                $voucher->referrence = $referrence;

                $voucher->transaction_mode = $transaction_mode;
                $voucher->transaction_mode_name = $transaction_mode_name;
                $voucher->account_id = $account_id;
                $voucher->account_name = $account_name;
                $voucher->sub_account_id = $sub_account_id;
                $voucher->sub_account_name = $sub_account_name;
                $voucher->hr_id = $hr;
                $voucher->save();

               
                $voucher_id_select = Voucher::orderBy('id','DESC')->first();
                $voucher_id = $voucher_id_select->id;

                //voucher-Debit
                $voucher_debit = new VoucherDebit();
                $voucher_debit->voucher_id = $voucher_id;
                $voucher_debit->amount = $amount;
                $voucher_debit->voucher_type = $voucher_type;
                $voucher_debit->account_id = $account_id;
                $voucher_debit->sub_account_id = $sub_account_id;
                $voucher_debit->date = $date;
                $voucher_debit->save();


                //voucher-Credit
                $voucher_credit = new VoucherCredit();
                $voucher_credit->voucher_id = $voucher_id;
                $voucher_credit->amount = $amount;
                $voucher_credit->voucher_type = $voucher_type;
                $voucher_credit->transaction_mode = $transaction_mode;
                $voucher_credit->date = $date;
                $voucher_credit->save();

                //view print hr record

                $hr_record = new HrRecord();
                $hr_record->hr = $hr;
                $hr_record->date = $date;
                $hr_record->p_advance = $amount;
                $hr_record->save();

                return redirect()->back()->with('success', 'Data Inserted Successfully');
            }


            //Loan Receivable-HR
            if ($account_id == 112) {
                //creating journal
                $company_name = "XPERT SEO SERVICE";
                $voucher_type = 1;
                $date = $date;
                $transaction_mode = 1;
                $transaction_mode_name = 'Cash';
                $referrence = $date;
                $account_id = 112;
                $account_name = 'Loan Receivable-HR';
                $sub_account_id = 35;
                $sub_account_name = 'STAFFS';


                $voucher = new Voucher();
                $voucher->company_name = $company_name;
                $voucher->voucher_type = $voucher_type;
                $voucher->date = $date;
                $voucher->transaction_mode = $transaction_mode;
                $voucher->transaction_mode_name = $transaction_mode_name;
                $voucher->referrence = $referrence;
                $voucher->account_id = $account_id;
                $voucher->account_name = $account_name;
                $voucher->sub_account_id = $sub_account_id;
                $voucher->sub_account_name = $sub_account_name;
                $voucher->hr_id = $hr;
                $voucher->save();

                $voucher_data = Voucher::orderBy('id','DESC')->first();
                $voucher_id = $voucher_data->id;

                //Debit voucher 
                $voucher_debit = new VoucherDebit();
                $voucher_debit->voucher_id = $voucher_id;
                $voucher_debit->amount = $amount;
                $voucher_debit->voucher_type = $voucher_type;
                $voucher_debit->account_id = $account_id;
                $voucher_debit->sub_account_id = $sub_account_id;
                $voucher_debit->date = $date;
                $voucher_debit->save();

                //Credit voucher 
                $voucher_credit = new VoucherCredit();
                $voucher_credit->voucher_id = $voucher_id;
                $voucher_credit->amount = $amount;
                $voucher_credit->voucher_type = $voucher_type;
                $voucher_credit->transaction_mode = $transaction_mode;
                $voucher_credit->date = $date;
                $voucher_credit->save();

                //End journal
                return redirect()->back()->with('success', 'Data Inserted Successfully');

            }



            //Payroll & Wages Payable

            if ($account_id == 115) {

                //check
               $input_year =  date('Y',strtotime($date));
               $input_month = date('m', strtotime($date));

               $hr_record = HrRecord::where('hr',$hr)->orderBy('id','DESC')->first();
               $db_date = $hr_record->date;

               $db_year =  date('Y',strtotime($db_date));
               $db_month = date('m', strtotime($db_date));

                if ($input_year == $db_year && $input_month == $db_month) {
                    return redirect()->back()->with('error', 'Payroll out of limit !');
                }
               
               
                
                //endcheck

                //Data initialize for voucher
                $company_name = "XPERT SEO SERVICE";
                $voucher_type = 1;
                $transaction_mode = 1;
                $transaction_mode_name = "Cash";
                $account_id = 115;
                $account_name = "Payroll & Wages Payable";
                $sub_account_id = 35;
                $sub_account_name = "STAFF";

                $voucher_count = Voucher::where('date', $date)->where('referrence', $referrence)->where('account_id',  '115')->where('transaction_mode', 1)->count();

                if ($voucher_count == 0) {

                    $voucher = new Voucher();
                    $voucher->company_name = $company_name;
                    $voucher->voucher_type = $voucher_type;
                    $voucher->date = $date;
                    $voucher->transaction_mode = $transaction_mode;
                    $voucher->transaction_mode_name = $transaction_mode_name;
                    $voucher->referrence = $referrence;
                    $voucher->account_id = $account_id;
                    $voucher->account_name = $account_name;
                    $voucher->sub_account_id = $sub_account_id;
                    $voucher->sub_account_name = $sub_account_name;

                    $voucher->save();

                   
                    $voucher_id_select = Voucher::orderBy('id','DESC')->first();
                    $voucher_id = $voucher_id_select->id;

                    //Initialize voucher Debit 

                    $voucher_debit = new VoucherDebit();
                    $voucher_debit->voucher_id = $voucher_id;
                    $voucher_debit->amount = $amount;
                    $voucher_debit->voucher_type = $voucher_type;
                    $voucher_debit->account_id = $account_id;
                    $voucher_debit->sub_account_id = $sub_account_id;
                    $voucher_debit->date = $date;
                    $voucher_debit->save();

                    //Initialize voucher Credit
                    $voucher_credit = new VoucherCredit();
                    $voucher_credit->voucher_id = $voucher_id;
                    $voucher_credit->amount = $amount;
                    $voucher_credit->voucher_type = $voucher_type;
                    $voucher_credit->transaction_mode = $transaction_mode;
                    $voucher_credit->date = $date;
                    $voucher_credit->save();

                    //view print hr record inserted
                    $job_record = JobRecord::where('hr', $hr)->orderBy('id', 'DESC')->first();
                    $gross_salary = $job_record->gross_salary;


                    $hr_record = new HrRecord();
                    $hr_record->hr = $hr;
                    $hr_record->date = $date;
                    $hr_record->a_payroll = $gross_salary;
                    $hr_record->save();

                    return redirect()->back()->with('success', 'Data Inserted Successfully');
                } else {

                    $voucher_id_select = Voucher::orderBy('id','DESC')->first();
                    $voucher_id = $voucher_id_select->id;

                    //update Debit Amount

                    $voucher_debit = VoucherDebit::where('voucher_id', $voucher_id)->first();
                    $current_amount = $voucher_debit->amount;

                    $voucher_debit->amount = $current_amount + $amount;
                    $voucher_debit->save();


                    //update Credit Amount 

                    $voucher_credit = VoucherCredit::where('voucher_id', $voucher_id)->first();
                    $current_amount = $voucher_credit->amount;
                    $voucher_credit->amount = $current_amount + $amount;
                    $voucher_credit->save();


                    //view print hr record inserted
                    $job_record = JobRecord::where('hr', $hr)->orderBy('id', 'DESC')->first();
                    $due_net_payroll = $job_record->due_net_payroll;

                    $hr_record = new HrRecord();
                    $hr_record->hr = $hr;
                    $hr_record->date = $date;
                    $hr_record->a_payroll = $due_net_payroll;
                    $hr_record->save();

                    return redirect()->back()->with('success', 'Data Inserted Successfully');
                }
            }
        }
    }

    public function payroll_ajax(Request $request){
       
        $hr = $request->input('hr');
        $account_id = $request->input('account_id');
        $initial_value = 0;
        if($account_id == 115){
            $job_record = JobRecord::where('hr',$hr)->orderBy('id','DESC')->first();
            $due_net_payroll = $job_record->due_net_payroll;
            return response()->json($due_net_payroll);

        }else{
            return response()->json($initial_value);
        }
       
    }

    public function job_record_history_delete($id){
        $delete_data = JobRecordExtra::where('id',$id)->delete();
        return redirect()->back()->with('success','Data Deleted Successsfully');
    }
}
