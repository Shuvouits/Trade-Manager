<?php

namespace App\Http\Controllers;

use App\Models\AccountAdjust;
use App\Models\Auth;
use App\Models\Bank;
use App\Models\ChartChild;
use App\Models\HR;
use App\Models\HrRecord;
use App\Models\JobRecord;
use App\Models\OpeningBalance;
use App\Models\PatronCategory;
use App\Models\PatronDetails;
use App\Models\PatronOpeningBalance;
use App\Models\PayrollBreakupBasic;
use App\Models\Project;
use App\Models\TransactionArea;
use App\Models\TransactionMode;
use App\Models\TrialBalance;
use App\Models\Voucher;
use App\Models\VoucherCredit;
use App\Models\VoucherDebit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AccountsController extends Controller
{
    public function receive_voucher()
    {
        $transaction_mode = TransactionMode::all();
        $project = Project::all();
        $bank = Bank::all();

       

        $patron_details = PatronDetails::all();
        $patron_category = PatronCategory::all();

       


        return view('accounts.receive-voucher', compact('transaction_mode', 'project', 'bank','patron_details','patron_category'));
    }

    public function cash_post(Request $request)
    {

        $transaction_mode = $request->input('transaction_mode');

        $transaction_area = TransactionArea::where('transaction_mode', $transaction_mode)->where('voucher_type', '0')->get();

        return response()->json($transaction_area);
    }

    public function sub_account_id(Request $request)
    {
        $transaction_mode = $request->input('transaction_mode');
        $account_id = $request->input('account_id');
        //$sub_account_id = $request->input('sub_account_id');

        $transaction_area_count = TransactionArea::where('transaction_mode', $transaction_mode)->where('child_account', $account_id)->count();

        if ($transaction_area_count == 0) {
        } else {
            $transaction_area = TransactionArea::where('transaction_mode', $transaction_mode)->where('child_account', $account_id)->first();
            $patron_status = $transaction_area->patron_status;

            $patron_details = PatronDetails::where('patron_status', $patron_status)->orderBy('patron_name')->get();

            return response()->json($patron_details);
        }
    }

    public function bank_post(Request $request)
    {

        $transaction_mode = $request->input('transaction_mode');

        $transaction_area = TransactionArea::where('transaction_mode', $transaction_mode)->where('voucher_type', '0')->get();

        return response()->json($transaction_area);
    }

    public function credit_post(Request $request)
    {

        $transaction_mode = $request->input('transaction_mode');

        $transaction_area = TransactionArea::where('transaction_mode', $transaction_mode)->where('voucher_type', '0')->get();

        return response()->json($transaction_area);
    }


    public function dues_post(Request $request)
    {

        $transaction_mode = $request->input('transaction_mode');

        $transaction_area = TransactionArea::where('transaction_mode', $transaction_mode)->where('voucher_type', '0')->get();

        return response()->json($transaction_area);
    }

    public function payment_voucher()
    {


        $transaction_mode = TransactionMode::all();
        $project = Project::all();
        $bank = Bank::all();

        //$voucher = Voucher::where('voucher_type',1)->orderBy('id','ASC')->get();

        //$voucher_debit = VoucherDebit::all();
       // $voucher_credit = VoucherCredit::all();

        $patron_details = PatronDetails::all();
        $patron_category = PatronCategory::all();

        //$hr = HR::all();
        return view('accounts.payment-voucher', compact('transaction_mode', 'project', 'bank',  'patron_details','patron_category'));
    }

    public function payment_cash_post(Request $request)
    {

        $transaction_mode = $request->input('transaction_mode');

        $cash_transaction_area = TransactionArea::where('transaction_mode', $transaction_mode)->where('voucher_type', '1')->get();

        return response()->json($cash_transaction_area);
    }


    public function payment_bank_post(Request $request)
    {

        $transaction_mode = $request->input('transaction_mode');

        $cash_transaction_area = TransactionArea::where('transaction_mode', $transaction_mode)->where('voucher_type', '1')->get();

        return response()->json($cash_transaction_area);
    }



    public function payment_credit_post(Request $request)
    {

        $transaction_mode = $request->input('transaction_mode');

        $credit_transaction_area = TransactionArea::where('transaction_mode', $transaction_mode)->where('voucher_type', '1')->get();

        return response()->json($credit_transaction_area);
    }


    public function payment_dues_post(Request $request)
    {

        $transaction_mode = $request->input('transaction_mode');

        $credit_transaction_area = TransactionArea::where('transaction_mode', $transaction_mode)->where('voucher_type', '1')->get();

        return response()->json($credit_transaction_area);
    }

    public function payment_voucher_post(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'company_name' => 'required',
            'date' => 'required',
            'transaction_mode' => 'required',
            'referrence' => 'required',
            'project_id' => 'required',
            'account_id' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $company_name = $request->input('company_name');

            $date_data = $request->input('date');
            //session purpose
            
            session()->put('session_date_data',$date_data);
            //return session()->get('session_date_data');

            //end
           
           
            $date = date('Y-m-d', strtotime($request->input('date')));
            $transaction_mode = $request->input('transaction_mode');
            $referrence = $request->input('referrence');
            session()->put('session_referrence_number', $referrence);
            $project_id = $request->input('project_id');
            $account_id = $request->input('account_id');



            $sub_account_id = $request->input('sub_account_id');



            $amount_credit = $request->input('amount_credit');
            $amount_cash = $request->input('amount_cash');
            $amount_dues = $request->input('amount_dues');
            $amount_bank = $request->input('amount_bank');



            $bank_id = $request->input('bank_id');


            $cheque = $request->input('cheque');
            $voucher_type = $request->input('voucher_type');

             //patron validation
             $check_patron_validation = TransactionArea::where('transaction_mode',$transaction_mode)->where('child_account', $account_id)->where('voucher_type',1)->first();
             $check_patron_status = $check_patron_validation->patron_status;
             if($check_patron_status !='' && $sub_account_id == ''){
                 return redirect()->back()->with('error','Error Voucher please select patron');
             }

            //partial validator

            if ($transaction_mode == 1 && $account_id == 83) {

                $validator = Validator::make($request->all(), [

                    'amount_bank' => 'required',
                    'bank_id' => 'required'

                ]);
                if ($validator->fails()) {
                    return back()->withInput()->withErrors($validator);
                }
            }


            if ($transaction_mode == 1  && $account_id != 83 ) {

                $validator = Validator::make($request->all(), [

                    'amount_cash' => 'required',


                ]);
                if ($validator->fails()) {
                    return back()->withInput()->withErrors($validator);
                }
            }

            if ($transaction_mode == 2) {

                $validator = Validator::make($request->all(), [

                    'amount_bank' => 'required',
                    'bank_id' => 'required'


                ]);
                if ($validator->fails()) {
                    return back()->withInput()->withErrors($validator);
                }
            }

            if ($transaction_mode == 3) {

                $validator = Validator::make($request->all(), [

                    "amount_credit" => 'required',

                ]);
                if ($validator->fails()) {
                    return back()->withInput()->withErrors($validator);
                }
            }

            if ($transaction_mode == 4) {

                $validator = Validator::make($request->all(), [

                    "amount_dues" => 'required',
                    //'bank_id' => 'required'


                ]);
                if ($validator->fails()) {
                    return back()->withInput()->withErrors($validator);
                }
            }



            //data render
            $chart_child = ChartChild::where('id', $account_id)->first();

            $account_name = $chart_child->name;



            if ($sub_account_id == '') {
                $sub_account_name = '';
            } else {

                $patron_details = PatronDetails::where('id', $sub_account_id)->first();
                $sub_account_name = $patron_details->patron_name;
            }

            $transaction_mode_data = TransactionMode::where('id', $transaction_mode)->first();
            $transaction_mode_name = $transaction_mode_data->name;



            if ($bank_id == '') {
                $bank_name = '';
            } else {
                $bank_data = Bank::where('id', $bank_id)->first();
                $bank_name = $bank_data->bank_name;
            }





            //query account adjust
         
            $account_adjust_count = AccountAdjust::where('account_id', $account_id)->where('transaction_mode', $transaction_mode)->where('voucher_type', $voucher_type)->count();
           
            if ($account_adjust_count > 0) {

                $account_adjust = AccountAdjust::where('account_id', $account_id)->where('transaction_mode', $transaction_mode)->where('voucher_type', $voucher_type)->first();
                $additional_account_id = $account_adjust->additional_account_id;

                $chart_child = ChartChild::where('id', $additional_account_id)->first();
                $additional_account_name = $chart_child->name;
            }
           //End query account adjust





            $voucher = new Voucher();
            $voucher->company_name = $company_name;
            $voucher->date = $date;


            //dues factor change
            if($transaction_mode == 4 && $bank_id ==''){
                $voucher->transaction_mode = 1;
                $voucher->transaction_mode_name = "cash";

            }else if($transaction_mode == 4 && $bank_id !=""){
                $voucher->transaction_mode = 2;
                $voucher->transaction_mode_name = "bank";

            }else{
                $voucher->transaction_mode = $transaction_mode;
                $voucher->transaction_mode_name = $transaction_mode_name;
            }
            //End dues factor chage
            
            $voucher->referrence = $referrence;
            $voucher->project_id = $project_id;
            $voucher->account_id = $account_id;
            $voucher->account_name = $account_name;
            $voucher->sub_account_id = $sub_account_id;
            $voucher->sub_account_name = $sub_account_name;

            //aditional account insert
            if ($account_adjust_count > 0) {
                $voucher->additional_account = $additional_account_id;
                $voucher->additional_account_name = $additional_account_name;
            }

            $voucher->bank_id = $bank_id;
            $voucher->bank_name = $bank_name;


            $voucher->cheque = $cheque;

            $voucher->voucher_type = $voucher_type;

            $voucher->save();

            $voucher_data = Voucher::all()->last();
            $voucher_id = $voucher_data->id;


            if ($voucher_type == 1 && $transaction_mode == 1) {

                $voucher_debit = new VoucherDebit();
                $voucher_debit->voucher_id = $voucher_id;
                $voucher_debit->voucher_type = $voucher_type;

                $voucher_debit->account_id = $account_id;
                $voucher_debit->sub_account_id = $sub_account_id;
                $voucher_debit->bank_id = $bank_id;

                if ($amount_cash == '') {
                    $voucher_debit->amount = $amount_bank;
                } else {
                    $voucher_debit->amount = $amount_cash;
                }

                $voucher_debit->date = $date;
                
                $voucher_debit->save();

                $voucher_credit = new VoucherCredit();
                $voucher_credit->voucher_id = $voucher_id;
                $voucher_credit->voucher_type = $voucher_type;

                $voucher_credit->transaction_mode = $transaction_mode;

               

                if ($amount_cash == '') {
                    $voucher_credit->amount = $amount_bank;
                } else {
                    $voucher_credit->amount = $amount_cash;
                }

                $voucher_credit->date = $date;
                $voucher_credit->save();
            }


            if ($voucher_type == 1 && $transaction_mode == 2) {

                $voucher_debit = new VoucherDebit();
                $voucher_debit->voucher_id = $voucher_id;
                $voucher_debit->voucher_type = $voucher_type;
                $voucher_debit->account_id = $account_id;
                $voucher_debit->sub_account_id = $sub_account_id;
                $voucher_debit->amount = $amount_bank;
                $voucher_debit->date = $date;
                $voucher_debit->save();

                $voucher_credit = new VoucherCredit();
                $voucher_credit->voucher_id = $voucher_id;
                $voucher_credit->voucher_type = $voucher_type;
                $voucher_credit->transaction_mode = $transaction_mode;
                $voucher_credit->bank_id = $bank_id;
                $voucher_credit->amount = $amount_bank;
                $voucher_credit->date = $date;
                $voucher_credit->save();
            }




            if ($voucher_type == 1 && $transaction_mode == 3) {

                $voucher_debit = new VoucherDebit();
                $voucher_debit->voucher_id = $voucher_id;
                $voucher_debit->voucher_type = $voucher_type;
                $voucher_debit->account_id = $account_id;
                $voucher_debit->amount = $amount_credit;
                $voucher_debit->date = $date;
                $voucher_debit->save();

                $voucher_credit = new VoucherCredit();
                $voucher_credit->voucher_id = $voucher_id;
                $voucher_credit->voucher_type = $voucher_type;
                $voucher_credit->sub_account_id = $sub_account_id;
               // $voucher_credit->transaction_mode = $transaction_mode;
                $voucher_credit->amount = $amount_credit;
                $voucher_credit->additional_account = $additional_account_id;
                $voucher_credit->date = $date;
                $voucher_credit->save();
            }

            if ($voucher_type == 1 && $transaction_mode == 4) {

                $voucher_debit = new VoucherDebit();
                $voucher_debit->voucher_id = $voucher_id;
                $voucher_debit->voucher_type = $voucher_type;
                $voucher_debit->account_id = $account_id;
                $voucher_debit->sub_account_id = $sub_account_id;
                $voucher_debit->amount = $amount_dues;
                $voucher_debit->date = $date;
                $voucher_debit->save();


                $voucher_credit = new VoucherCredit();
                $voucher_credit->voucher_id = $voucher_id;
                $voucher_credit->voucher_type = $voucher_type;

                //transaction change
                if($bank_id == ''){
                    $voucher_credit->transaction_mode = 1;

                }else{
                    $voucher_credit->transaction_mode = 2;
                }
                
                //End transaction change
               
                $voucher_credit->bank_id = $bank_id;
                $voucher_credit->amount = $amount_dues;
                $voucher_credit->date = $date;
                $voucher_credit->save();
            }

           




            return redirect()->back()->with('success', 'New Voucher Inserted Successfully');
        }
    }


    public function receive_voucher_post(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'company_name' => 'required',
            'date' => 'required',
            'transaction_mode' => 'required',
            'referrence' => 'required',
            'project_id' => 'required',
            'account_id' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $company_name = $request->input('company_name');

            $date_data = $request->input('date');
            //session purpose
            
            session()->put('session_date_data',$date_data);
          
            //return session()->get('session_date_data');

            //end

            
            $date= date('Y-m-d', strtotime($request->input('date')));
            $transaction_mode = $request->input('transaction_mode');
          
            $referrence = $request->input('referrence');
            session()->put('session_referrence_number', $referrence);
            $project_id = $request->input('project_id');
            $account_id = $request->input('account_id');
            $sub_account_id = $request->input('sub_account_id');

           



            $amount_credit = $request->input('amount_credit');
            $amount_cash = $request->input('amount_cash');

            $amount_dues = $request->input('amount_dues');
            $amount_bank = $request->input('amount_bank');



            $bank_id = $request->input('bank_id');
            $cheque = $request->input('cheque');
            $voucher_type = $request->input('voucher_type');

            //patron validation
            $check_patron_validation = TransactionArea::where('transaction_mode',$transaction_mode)->where('child_account', $account_id)->where('voucher_type',0)->first();
            $check_patron_status = $check_patron_validation->patron_status;
            if($check_patron_status !='' && $sub_account_id == ''){
                return redirect()->back()->with('error','Error Voucher please select patron');
            }


            //partial validator

            if ($transaction_mode == 1 && $account_id == 83) {

                $validator = Validator::make($request->all(), [

                    'amount_bank' => 'required',
                    'bank_id' => 'required'

                ]);
                if ($validator->fails()) {
                    return back()->withInput()->withErrors($validator);
                }
            }


            if ($transaction_mode == 1  && $account_id != 83) {

                $validator = Validator::make($request->all(), [

                    'amount_cash' => 'required',

                ]);
                if ($validator->fails()) {
                    return back()->withInput()->withErrors($validator);
                }
            }

            if ($transaction_mode == 2) {

                $validator = Validator::make($request->all(), [

                    'amount_bank' => 'required',
                    'bank_id' => 'required'


                ]);
                if ($validator->fails()) {
                    return back()->withInput()->withErrors($validator);
                }
            }

            if ($transaction_mode == 3) {

                $validator = Validator::make($request->all(), [

                    "amount_credit" => 'required',
                   


                ]);
                if ($validator->fails()) {
                    return back()->withInput()->withErrors($validator);
                }
            }

            if ($transaction_mode == 4) {

                $validator = Validator::make($request->all(), [

                    "amount_dues" => 'required'


                ]);
                if ($validator->fails()) {
                    return back()->withInput()->withErrors($validator);
                }
            }



            //data render
            $chart_child = ChartChild::where('id', $account_id)->first();

            $account_name = $chart_child->name;

            if ($sub_account_id == '') {
                $sub_account_name = '';
            } else {

                $patron_details = PatronDetails::where('id', $sub_account_id)->first();
                $sub_account_name = $patron_details->patron_name;
            }



            $transaction_mode_data = TransactionMode::where('id', $transaction_mode)->first();
            $transaction_mode_name = $transaction_mode_data->name;



            if ($bank_id == '') {
                $bank_name = '';
            } else {
                $bank_data = Bank::where('id', $bank_id)->first();
                $bank_name = $bank_data->bank_name;
            }


            //query account adjust
            $account_adjust_count = AccountAdjust::where('account_id', $account_id)->where('transaction_mode', $transaction_mode)->where('voucher_type', $voucher_type)->count();
            if ($account_adjust_count > 0) {

                $account_adjust = AccountAdjust::where('account_id', $account_id)->where('transaction_mode', $transaction_mode)->where('voucher_type', $voucher_type)->first();
                $additional_account_id = $account_adjust->additional_account_id;

                $chart_child = ChartChild::where('id', $additional_account_id)->first();
                $additional_account_name = $chart_child->name;
            }
           //End query account adjust


            $voucher = new Voucher();
            $voucher->company_name = $company_name;
            $voucher->date = $date;

             //dues factor change
             if($transaction_mode == 4 && $bank_id ==''){
                $voucher->transaction_mode = 1;
                $voucher->transaction_mode_name = "Cash";

            }else if($transaction_mode == 4 && $bank_id !=""){
                $voucher->transaction_mode = 2;
                $voucher->transaction_mode_name = "bank";

            }else{
                $voucher->transaction_mode = $transaction_mode;
                $voucher->transaction_mode_name = $transaction_mode_name;
            }
            //End dues factor chage

           

            $voucher->referrence = $referrence;
            $voucher->project_id = $project_id;

            $voucher->account_id = $account_id;
            $voucher->account_name = $account_name;

            $voucher->sub_account_id = $sub_account_id;
            $voucher->sub_account_name = $sub_account_name;


            //aditional account insert
            if ($account_adjust_count > 0) {
                $voucher->additional_account = $additional_account_id;
                $voucher->additional_account_name = $additional_account_name;
            }


            $voucher->bank_id = $bank_id;
            $voucher->bank_name = $bank_name;


            $voucher->cheque = $cheque;

            $voucher->voucher_type = $voucher_type;

            $voucher->save();

            $voucher_data = Voucher::all()->last();
            $voucher_id = $voucher_data->id;


            if ($voucher_type == 0 && $transaction_mode == 1) {

                $voucher_debit = new VoucherDebit();
                $voucher_debit->voucher_id = $voucher_id;
                $voucher_debit->voucher_type = $voucher_type;

                $voucher_debit->transaction_mode = $transaction_mode;

                if ($amount_cash == '') {
                    $voucher_debit->amount = $amount_bank;
                } else {
                    $voucher_debit->amount = $amount_cash;
                }

                $voucher_debit->date = $date;
                $voucher_debit->save();

                $voucher_credit = new VoucherCredit();
                $voucher_credit->voucher_id = $voucher_id;
                $voucher_credit->voucher_type = $voucher_type;

                $voucher_credit->account_id = $account_id;
                $voucher_credit->sub_account_id = $sub_account_id;
                $voucher_credit->bank_id = $bank_id;

                if ($amount_cash == '') {
                    $voucher_credit->amount = $amount_bank;
                } else {
                    $voucher_credit->amount = $amount_cash;
                }

                $voucher_credit->date = $date;
                $voucher_credit->save();
            }


            if ($voucher_type == 0 && $transaction_mode == 2) {

                $voucher_debit = new VoucherDebit();
                $voucher_debit->voucher_id = $voucher_id;
                $voucher_debit->voucher_type = $voucher_type;

                $voucher_debit->transaction_mode = $transaction_mode;
                $voucher_debit->bank_id = $bank_id;
                $voucher_debit->amount = $amount_bank;
                $voucher_debit->date = $date;
                $voucher_debit->save();

                $voucher_credit = new VoucherCredit();
                $voucher_credit->voucher_id = $voucher_id;
                $voucher_credit->voucher_type = $voucher_type;

                $voucher_credit->account_id = $account_id;
                $voucher_credit->sub_account_id = $sub_account_id;

                $voucher_credit->amount = $amount_bank;
                $voucher_credit->date = $date;
                $voucher_credit->save();
            }




            if ($voucher_type == 0 && $transaction_mode == 3) {

                $voucher_debit = new VoucherDebit();
                $voucher_debit->voucher_id = $voucher_id;
                $voucher_debit->voucher_type = $voucher_type;
                $voucher_debit->sub_account_id = $sub_account_id;
                $voucher_debit->amount = $amount_credit;
                $voucher_debit->additional_account = $additional_account_id;
                $voucher_debit->date = $date;
                $voucher_debit->save();

                $voucher_credit = new VoucherCredit();
                $voucher_credit->voucher_id = $voucher_id;
                $voucher_credit->voucher_type = $voucher_type;
                $voucher_credit->account_id = $account_id;
                //$voucher_credit->transaction_mode = $transaction_mode;
                $voucher_credit->amount = $amount_credit;
                $voucher_credit->date = $date;
                $voucher_credit->save();
            }

            if ($voucher_type == 0 && $transaction_mode == 4) {

                $voucher_debit = new VoucherDebit();
                $voucher_debit->voucher_id = $voucher_id;
                $voucher_debit->voucher_type = $voucher_type;

                if($bank_id == ''){
                    $voucher_debit->transaction_mode = 1;

                }else if($bank_id !=''){
                    $voucher_debit->bank_id = $bank_id;
                }
               
               
               
                $voucher_debit->amount = $amount_dues;
                $voucher_debit->date = $date;
                $voucher_debit->save();


                $voucher_credit = new VoucherCredit();
                $voucher_credit->voucher_id = $voucher_id;
                $voucher_credit->voucher_type = $voucher_type;
                $voucher_credit->account_id = $account_id;
                $voucher_credit->sub_account_id = $sub_account_id;
                $voucher_credit->amount = $amount_dues;
                $voucher_credit->date = $date;
                $voucher_credit->save();
            }

           
            return redirect()->back()->with('success', 'New Voucher Inserted Successfully');
        }
    }


    public function adjust_account(){
        $transaction_mode = TransactionMode::all();
        $chart_child = ChartChild::all();
        return view('accounts.adjust-account', compact('transaction_mode','chart_child'));
    }

    public function adjust_account_post(Request $request){

        $validator = Validator::make($request->all(), [

            'company_name' => 'required',
            'voucher_type' => 'required',
            'transaction_mode' => 'required',
            'account_id' => 'required',
            'additional_account_id' => 'required',
            
        ]);
        
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }else{

            $company_name = $request->input('company_name');
            $voucher_type = $request->input('voucher_type');
            $transaction_mode = $request->input('transaction_mode');
            $account_id = $request->input('account_id');
            $additional_account_id = $request->input('additional_account_id');

            $account_adjust = New AccountAdjust();
            $account_adjust->company_name = $company_name;
            $account_adjust->voucher_type = $voucher_type;
            $account_adjust->transaction_mode = $transaction_mode;
            $account_adjust->account_id = $account_id;
            $account_adjust->additional_account_id = $additional_account_id;
            $account_adjust->save();

            return redirect()->back()->with('success', 'New Account Setup Successfully');


        }

    }

    public function adjust_account_history(){

        $account_adjust = AccountAdjust::all();
        $transaction_mode = TransactionMode::all();
        $chart_child = ChartChild::all();
        return view('accounts.adjust-account-history', compact('account_adjust', 'transaction_mode','chart_child'));
    }

    public function journal_delete(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'company_name' => 'required',
            'date' => 'required',
            'password' => 'required',


        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

       
            $date = date('Y-m-d', strtotime($request->input('date')));
            $password = md5($request->input('password'));
            $id = $request->input('voucher_id');

            $auth_count = Auth::where('password', $password)->count();

            if ($auth_count > 0) {

                $voucher_data = Voucher::where('id', $id)->first();
                $account_id = $voucher_data->account_id;
                $date = $voucher_data->date;
                $hr_id = $voucher_data->hr_id;

                //Payroll account
                if ($account_id == 79) {
                    $job_record = JobRecord::where('date', $date)->delete();
                    $hr_record = HrRecord::where('date', $date)->delete();
                    $voucher = Voucher::where('id', $id)->delete();
                    $voucher_debit = VoucherDebit::where('voucher_id', $id)->delete();
                    $voucher_credit = VoucherCredit::where('voucher_id', $id)->delete();
                    return redirect()->back()->with('success', 'Data Deleted Successfully');
                } else if ($account_id == 115) {
                    //Payroll & wages Payable

                    $hr_record = HrRecord::where('date', $date)->delete();
                    $voucher = Voucher::where('id', $id)->delete();
                    $voucher_debit = VoucherDebit::where('voucher_id', $id)->delete();
                    $voucher_credit = VoucherCredit::where('voucher_id', $id)->delete();
                    return redirect()->back()->with('success', 'Data Deleted Successfully');
                } else if ($account_id == 111) {
                    //Advance Payroll 

                    $hr_record = HrRecord::where('date', $date)->where('hr', $hr_id)->delete();
                    $voucher = Voucher::where('id', $id)->delete();
                    $voucher_debit = VoucherDebit::where('voucher_id', $id)->delete();
                    $voucher_credit = VoucherCredit::where('voucher_id', $id)->delete();

                    $payroll_breakup_basic = PayrollBreakupBasic::where('hr', $hr_id)->first();
                    $payroll_breakup_basic->advance_salary = 0;
                    $payroll_breakup_basic->save();
                    return redirect()->back()->with('success', 'Data Deleted Successfully');
                } else if ($account_id == 112) {
                    //loan receive hr

                    $hr_record = HrRecord::where('date', $date)->where('hr', $hr_id)->delete();
                    $voucher = Voucher::where('id', $id)->delete();
                    $voucher_debit = VoucherDebit::where('voucher_id', $id)->delete();
                    $voucher_credit = VoucherCredit::where('voucher_id', $id)->delete();

                    $payroll_breakup_basic = PayrollBreakupBasic::where('hr', $hr_id)->first();
                    $payroll_breakup_basic->loan_limit = 0;
                    $payroll_breakup_basic->loan_adjust = 0;
                    $payroll_breakup_basic->current_loan = 0;
                    $payroll_breakup_basic->save();
                    return redirect()->back()->with('success', 'Data Deleted Successfully');
                } else {

                    $voucher = Voucher::where('id', $id)->delete();
                    $voucher_debit = VoucherDebit::where('voucher_id', $id)->delete();
                    $voucher_credit = VoucherCredit::where('voucher_id', $id)->delete();
                    return redirect()->back()->with('success', 'Data Deleted Successfully');
                }
            } else {
                return redirect()->back()->with('error', "Error !! Data didn't remove");
            }
        }
    }

    public function opening_balance(){
        $chart_child = ChartChild::all();
        $bank = Bank::all();
        $opening_balance = OpeningBalance::all();
        $sum_debit = OpeningBalance::sum('debit_balance');
        $sum_credit = OpeningBalance::sum('credit_balance');
       
        return view('accounts.opening-balance',compact('chart_child','opening_balance','bank', 'sum_debit','sum_credit'));
    }

    public function opening_balance_post(Request $request){

        $validator = Validator::make($request->all(), [

            'company_name' => 'required',
            'date' => 'required',
            'account_id' => 'required',
            'balance_option' => 'required',
            'amount' => 'required'


        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }else{
            $company_name = $request->input('company_name');

            $date = date('Y-m-d', strtotime($request->input('date')));
            $account_id = $request->input('account_id');
            $balance_option = $request->input('balance_option');
           
            $amount = $request->input('amount');
            $bank_id = $request->input('bank_id');
           

            $chart_child = ChartChild::where('id',$account_id)->first();
            $account_name = $chart_child->name;

            $opening_balance_count = OpeningBalance::where('account_id',$account_id)->count();
            
            if($opening_balance_count == 0){
                $opening_balance = New OpeningBalance();
                $opening_balance->date = $date;
                $opening_balance->account_id = $account_id;
                $opening_balance->account_name = $account_name;

                
                if($balance_option == 1){
                    $opening_balance->debit_balance = $amount;

                }else if($balance_option == 2){
                    $opening_balance->credit_balance = $amount;
                }

                if($bank_id != ''){
                    $opening_balance->bank_id = $bank_id;
                   
                }

                if($account_id == 81){
                    $opening_balance->transaction_mode = 1;
                }else if($account_id == 83){
                    $opening_balance->transaction_mode = 2;
                }
                
                $opening_balance->save();

                if($account_id == 81 ){
                    $voucher = new Voucher();
                    $voucher->account_id = "";
                    $voucher->transaction_mode = 1;
                    $voucher->account_name = "Cash";
                    $voucher->date = $date;
                    $voucher->opening_balance = 1;
                    $voucher->save(); 

                    $voucher_data = Voucher::orderBy('id','DESC')->first();
                    $voucher_id = $voucher_data->id;

                    if($balance_option == 1){
                        $voucher_debit = New VoucherDebit();
                        $voucher_debit->voucher_id = $voucher_id;
                        $voucher_debit->date = $date;
                        $voucher_debit->amount = $amount;
                        $voucher_debit->opening_balance = 1;
                        $voucher_debit->transaction_mode = 1;
                        $voucher_debit->save();

                    }else if($balance_option == 2){
                        $voucher_credit = New VoucherCredit();
                        $voucher_credit->voucher_id = $voucher_id;
                        $voucher_credit->date = $date;
                        $voucher_credit->amount = $amount;
                        $voucher_credit->opening_balance = 1;
                        $voucher_credit->transaction_mode = 1;
                        $voucher_credit->save();

                    }

                }else if($account_id == 83){
                    $voucher = new Voucher();
                    $voucher->account_id = "";
                    $voucher->transaction_mode = 2;
                    $voucher->account_name = "Bank";
                    $voucher->date = $date;
                    $voucher->bank_id = $bank_id;
                    $voucher->opening_balance = 1;
                    $voucher->save(); 

                    $voucher_data = Voucher::orderBy('id','DESC')->first();
                    $voucher_id = $voucher_data->id;

                    if($balance_option == 1){
                        $voucher_debit = New VoucherDebit();
                        $voucher_debit->voucher_id = $voucher_id;
                        $voucher_debit->date = $date;
                        $voucher_debit->amount = $amount;
                        $voucher_debit->opening_balance = 1;
                        $voucher_debit->transaction_mode = 2;
                        $voucher_debit->bank_id = $bank_id;
                        $voucher_debit->save();

                    }else if($balance_option == 2){
                        $voucher_credit = New VoucherCredit();
                        $voucher_credit->voucher_id = $voucher_id;
                        $voucher_credit->date = $date;
                        $voucher_credit->amount = $amount;
                        $voucher_credit->opening_balance = 1;
                        $voucher_credit->transaction_mode = 2;
                        $voucher_credit->bank_id = $bank_id;
                        $voucher_credit->save();

                    }



                }else{

                    $voucher = new Voucher();
                    $voucher->account_id = $account_id;
                   
                    $voucher->account_name = $account_name;
                    $voucher->date = $date;
                    $voucher->bank_id = $bank_id;
                    $voucher->opening_balance = 1;
                    $voucher->save(); 

                    $voucher_data = Voucher::orderBy('id','DESC')->first();
                    $voucher_id = $voucher_data->id;

                    if($balance_option == 1){
                        $voucher_debit = New VoucherDebit();
                        $voucher_debit->voucher_id = $voucher_id;
                        $voucher_debit->date = $date;
                        $voucher_debit->amount = $amount;
                        $voucher_debit->opening_balance = 1;
                        $voucher_debit->account_id = $account_id;
                        $voucher_debit->save();

                    }else if($balance_option == 2){
                        $voucher_credit = New VoucherCredit();
                        $voucher_credit->voucher_id = $voucher_id;
                        $voucher_credit->date = $date;
                        $voucher_credit->amount = $amount;
                        $voucher_credit->opening_balance = 1;
                        $voucher_credit->account_id = $account_id;
                        $voucher_credit->save();

                    }


                }

              
                return redirect()->back()->with('success', 'New Balance inserted successfully');

            }else{

                if($bank_id !=""){
                    $opening_balance_count_bank = OpeningBalance::where('account_id',$account_id)->where('bank_id',$bank_id)->count();
                    
                

                    if($opening_balance_count_bank == 0){
                        $opening_balance = New OpeningBalance();
                        $opening_balance->date = $date;
                        $opening_balance->account_id = $account_id;
                        $opening_balance->account_name = $account_name;
                        $opening_balance->bank_id = $bank_id;
                        $opening_balance->transaction_mode = 2;

                        if($balance_option == 1){
                            $opening_balance->debit_balance = $amount;
        
                        }else if($balance_option == 2){
                            $opening_balance->credit_balance = $amount;
                        }

                        
                        $opening_balance->save();

                        if($account_id == 81 ){
                            $voucher = new Voucher();
                            $voucher->account_id = "";
                            $voucher->transaction_mode = 1;
                            $voucher->account_name = "Cash";
                            $voucher->date = $date;
                            $voucher->opening_balance = 1;
                            $voucher->save(); 
        
                            $voucher_data = Voucher::orderBy('id','DESC')->first();
                            $voucher_id = $voucher_data->id;
        
                            if($balance_option == 1){
                                $voucher_debit = New VoucherDebit();
                                $voucher_debit->voucher_id = $voucher_id;
                                $voucher_debit->date = $date;
                                $voucher_debit->amount = $amount;
                                $voucher_debit->opening_balance = 1;
                                $voucher_debit->transaction_mode = 1;
                                $voucher_debit->save();
        
                            }else if($balance_option == 2){
                                $voucher_credit = New VoucherCredit();
                                $voucher_credit->voucher_id = $voucher_id;
                                $voucher_credit->date = $date;
                                $voucher_credit->amount = $amount;
                                $voucher_credit->opening_balance = 1;
                                $voucher_credit->transaction_mode = 1;
                                $voucher_credit->save();
        
                            }
        
                        }else if($account_id == 83){
                            
                            $voucher = new Voucher();
                            $voucher->account_id = "";
                            $voucher->transaction_mode = 2;
                            $voucher->account_name = "Bank";
                            $voucher->date = $date;
                            $voucher->bank_id = $bank_id;
                            $voucher->opening_balance = 1;
                            $voucher->save(); 
        
                            $voucher_data = Voucher::orderBy('id','DESC')->first();
                            $voucher_id = $voucher_data->id;
        
                            if($balance_option == 1){
                                
                                $voucher_debit = New VoucherDebit();
                                $voucher_debit->voucher_id = $voucher_id;
                                $voucher_debit->date = $date;
                                $voucher_debit->amount = $amount;
                                $voucher_debit->opening_balance = 1;
                                $voucher_debit->transaction_mode = 2;
                                $voucher_debit->bank_id = $bank_id;
                                $voucher_debit->save();
        
                            }else if($balance_option == 2){
                                $voucher_credit = New VoucherCredit();
                                $voucher_credit->voucher_id = $voucher_id;
                                $voucher_credit->date = $date;
                                $voucher_credit->amount = $amount;
                                $voucher_credit->opening_balance = 1;
                                $voucher_credit->transaction_mode = 2;
                                $voucher_credit->bank_id = $bank_id;
                                $voucher_credit->save();
        
                            }
        
        
        
                        }else{
        
                            $voucher = new Voucher();
                            $voucher->account_id = $account_id;
                           
                            $voucher->account_name = $account_name;
                            $voucher->date = $date;
                            $voucher->bank_id = $bank_id;
                            $voucher->opening_balance = 1;
                            $voucher->save(); 
        
                            $voucher_data = Voucher::orderBy('id','DESC')->first();
                            $voucher_id = $voucher_data->id;
        
                            if($balance_option == 1){
                                $voucher_debit = New VoucherDebit();
                                $voucher_debit->voucher_id = $voucher_id;
                                $voucher_debit->date = $date;
                                $voucher_debit->amount = $amount;
                                $voucher_debit->opening_balance = 1;
                                $voucher_debit->account_id = $account_id;
                                $voucher_debit->save();
        
                            }else if($balance_option == 2){
                                $voucher_credit = New VoucherCredit();
                                $voucher_credit->voucher_id = $voucher_id;
                                $voucher_credit->date = $date;
                                $voucher_credit->amount = $amount;
                                $voucher_credit->opening_balance = 1;
                                $voucher_credit->account_id = $account_id;
                                $voucher_credit->save();
        
                            }
        
        
                        }

                       

                        return redirect()->back()->with('success', 'New Balance inserted successfully');

                    }

                }
                return redirect()->back()->with('error', 'Your Balance already Exist please try updating');

            }

           
        }

    }

    public function opening_balance_data_delete($id){
        
        
        //data taking opening balance
        $opening_balance = OpeningBalance::where('id',$id)->first();
        $account_id = $opening_balance->account_id;
        $bank_id = $opening_balance->bank_id;

        if($account_id ==83){

            $voucher = Voucher::where('bank_id',$bank_id)->where('opening_balance',1)->first();
            $voucher_id = $voucher->id; 
    
            $voucher_debit_delete = VoucherDebit::where('voucher_id',$voucher_id)->where('opening_balance',1)->delete();
            $voucher_credit_delete = VoucherCredit::where('voucher_id',$voucher_id)->where('opening_balance',1)->delete();
            $voucher_delete = Voucher::where('bank_id',$bank_id)->where('opening_balance',1)->delete();
            $delete = OpeningBalance::where('id',$id)->delete();
    
    
            return redirect()->back()->with('success','Data Removed Successfully');

        }

        //DB::table('opening_balance')->delete();

        //$voucher = Voucher::where('opening_balance',1)->delete();
        //$voucher_debit = VoucherDebit::where('opening_balance',1)->delete();
        //$voucher_credit = VoucherCredit::where('opening_balance',1)->delete();
        //return redirect()->back();


        
         //data taking voucher
        $voucher = Voucher::where('account_id',$account_id)->where('opening_balance',1)->first();
        $voucher_id = $voucher->id; 

        $voucher_debit_delete = VoucherDebit::where('voucher_id',$voucher_id)->where('opening_balance',1)->delete();
        $voucher_credit_delete = VoucherCredit::where('voucher_id',$voucher_id)->where('opening_balance',1)->delete();
        $voucher_delete = Voucher::where('account_id',$account_id)->where('opening_balance',1)->delete();
        $delete = OpeningBalance::where('id',$id)->delete();


        return redirect()->back()->with('success','Data Removed Successfully');

    } 

    public function payment_voucher_view(){
      

        $voucher = Voucher::where('voucher_type',1)->orderBy('id','ASC')->get();

        $voucher_debit = VoucherDebit::all();
        $voucher_credit = VoucherCredit::all();

    

        $hr = HR::all(); 

        return view('accounts.payment-voucher-view', compact( 'voucher','voucher_debit','voucher_credit','hr'));

    }  


    public function receive_voucher_view(){
      
        $voucher = Voucher::where('voucher_type',0)->get();

        $voucher_debit = VoucherDebit::all();
        $voucher_credit = VoucherCredit::all();

        $hr = HR::all(); 

        return view('accounts.receive-voucher-view', compact( 'voucher','voucher_debit','voucher_credit','hr'));

    } 

    public function other_account(){
        $all_project = Project::all();
        
        $chart_child = ChartChild::all();
        return view('accounts.other-account', compact('all_project','chart_child'));
    } 

    public function other_account_bank_post(Request $request){
        $account_dr = $request->input('account_dr');

        $all_bank = Bank::all();
        return response()->json($all_bank);
    } 

    public function other_account_all_post(Request $request){
        $account_dr = $request->input('account_dr');

        if($account_dr == 83 || $account_dr == 81){

        }else{
            $all_patron = PatronDetails::all();
            return response()->json($all_patron);
        }
    } 

    public function other_account_post(Request $request){

        $validator = Validator::make($request->all(), [

            'company_name' => 'required',
            'date' => 'required',
            'referrence' => 'required',
            'project' => 'required',
            'account_dr' => 'required',
           
            'account_cr' => 'required',
            'amount' => 'required'


        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }else{

            $date = date('Y-m-d', strtotime($request->input('date')));
            $referrence = $request->input('referrence');
            $project_id = $request->input('project');
            $account_id = $request->input('account_dr');
            $sub_account_id = $request->input('sub_account_id');
            $additional_account = $request->input('account_cr');
            $amount = $request->input('amount'); 

            $chart_child = ChartChild::where('id', $account_id)->first();
            $account_name = $chart_child->name; 

            $chart_child_data = ChartChild::where('id', $additional_account)->first();
            $additional_account_name = $chart_child_data->name;


           

            //when cash

            if($account_id == 81){

                $voucher = New Voucher();
                $voucher->date = $date;
                $voucher->referrence = $referrence;
                $voucher->project_id = $project_id;
                $voucher->account_id = $account_id;
                $voucher->account_name = $account_name;
                $voucher->additional_account  = $additional_account;
                $voucher->additional_account_name  = $additional_account_name;
                $voucher->other_account = 1;
                $voucher->save();

                $voucher_data = Voucher::orderBy('id','DESC')->first();
                $voucher_id = $voucher_data->id;


                $voucher_debit = New VoucherDebit();
                $voucher_debit->voucher_id = $voucher_id;
                $voucher_debit->amount = $amount;
                $voucher_debit->date = $date; 
                $voucher_debit->account_id = $account_id;
                $voucher_debit->save(); 

                $voucher_credit = New VoucherCredit(); 
                $voucher_credit->voucher_id = $voucher_id; 
                $voucher_credit->amount = $amount;
                $voucher_credit->date = $date;
                $voucher_credit->additional_account = $additional_account; 
                $voucher_credit->save();

                return redirect()->back()->with('success','Data Inserted Successfully');


            }else if($account_id == 83){

                $bank_data = Bank::where('id', $sub_account_id)->first();
                $bank_id = $bank_data->id;
                $bank_name = $bank_data->bank_name;

                $voucher = New Voucher();
                $voucher->date = $date;
                $voucher->referrence = $referrence;
                $voucher->project_id = $project_id;
                $voucher->account_id = $account_id;
                $voucher->account_name = $account_name;
                $voucher->additional_account  = $additional_account;
                $voucher->additional_account_name  = $additional_account_name;
                $voucher->bank_id  = $bank_id;
                $voucher->bank_name  = $bank_name;
                $voucher->other_account = 1;
                $voucher->save();  

                $voucher_data = Voucher::orderBy('id','DESC')->first();
                $voucher_id = $voucher_data->id;


                $voucher_debit = New VoucherDebit();
                $voucher_debit->voucher_id = $voucher_id;
                $voucher_debit->amount = $amount;
                $voucher_debit->date = $date; 
                $voucher_debit->account_id = $account_id; 
                $voucher_debit->bank_id = $bank_id;
                $voucher_debit->save();  

                $voucher_credit = New VoucherCredit(); 
                $voucher_credit->voucher_id = $voucher_id; 
                $voucher_credit->amount = $amount;
                $voucher_credit->date = $date;
                $voucher_credit->additional_account = $additional_account; 
                $voucher_credit->save();

                return redirect()->back()->with('success','Data Inserted Successfully');



            }else{

                $patron = PatronDetails::where('id',$sub_account_id)->first();
                $sub_account_name = $patron->patron_name; 

                $voucher = New Voucher();
                $voucher->date = $date;
                $voucher->referrence = $referrence;
                $voucher->project_id = $project_id;
                $voucher->account_id = $account_id;
                $voucher->account_name = $account_name;

                $voucher->sub_account_id  = $sub_account_id;
                $voucher->sub_account_name  = $sub_account_name;

                $voucher->additional_account  = $additional_account;
                $voucher->additional_account_name  = $additional_account_name;
               
                $voucher->other_account = 1;
                $voucher->save(); 

                $voucher_data = Voucher::orderBy('id','DESC')->first();
                $voucher_id = $voucher_data->id;

                $voucher_debit = New VoucherDebit();
                $voucher_debit->voucher_id = $voucher_id;
                $voucher_debit->amount = $amount;
                $voucher_debit->date = $date; 
                $voucher_debit->account_id = $account_id; 
                $voucher_debit->sub_account_id = $sub_account_id;
                $voucher_debit->save();  

                $voucher_credit = New VoucherCredit(); 
                $voucher_credit->voucher_id = $voucher_id; 
                $voucher_credit->amount = $amount;
                $voucher_credit->date = $date;
                $voucher_credit->additional_account = $additional_account; 
                $voucher_credit->save();

                return redirect()->back()->with('success','Data Inserted Successfully');

            }


           


        }

    } 

    public function patron_opening_balance(){

        $all_patron = PatronDetails::all();
       
        $patron_opening_balance = PatronOpeningBalance::all();
        return view('accounts.patron-opening-balance',compact('all_patron','patron_opening_balance'));

    }

    public function patron_opening_balance_post(Request $request){

        $validator = Validator::make($request->all(), [

            'company_name' => 'required',
            'date' => 'required',
            'patron_id' => 'required',
            'balance_option' => 'required',
            'amount' => 'required'


        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }else{

            $company_name = $request->input('company_name');

            $date = date('Y-m-d', strtotime($request->input('date')));
            $patron_id = $request->input('patron_id');
            $balance_option = $request->input('balance_option');
           
            $amount = $request->input('amount');
           

            $patron = PatronDetails::where('id',$patron_id)->first();
            $patron_name = $patron->patron_name;

            $patron_opening_balance_count = PatronOpeningBalance::where('id',$patron_id)->count();

            if($patron_opening_balance_count == 0){

                $patron_opening_balance = New PatronOpeningBalance();
                $patron_opening_balance->date = $date;
                $patron_opening_balance->patron_id = $patron_id;
                $patron_opening_balance->patron_name = $patron_name;

                
                if($balance_option == 1){
                    $patron_opening_balance->debit_balance = $amount;

                }else if($balance_option == 2){
                    $patron_opening_balance->credit_balance = $amount;
                }

                $patron_opening_balance->save();

                $voucher = new Voucher();
                $voucher->sub_account_id = $patron_id;
               
                $voucher->sub_account_name = $patron_name;
                $voucher->date = $date;
               
                $voucher->opening_balance = 1;
                $voucher->save(); 

                $voucher_data = Voucher::orderBy('id','DESC')->first();
                $voucher_id = $voucher_data->id;

                if($balance_option == 1){
                    $voucher_debit = New VoucherDebit();
                    $voucher_debit->voucher_id = $voucher_id;
                    $voucher_debit->date = $date;
                    $voucher_debit->amount = $amount;
                    $voucher_debit->opening_balance = 1;
                    $voucher_debit->sub_account_id = $patron_id;
                    $voucher_debit->save();

                }else if($balance_option == 2){
                    $voucher_credit = New VoucherCredit();
                    $voucher_credit->voucher_id = $voucher_id;
                    $voucher_credit->date = $date;
                    $voucher_credit->amount = $amount;
                    $voucher_credit->opening_balance = 1;
                    $voucher_credit->sub_account_id = $patron_id;
                    $voucher_credit->save();

                }

                return redirect()->back()->with('success', 'New Balance inserted successfully');

                



            }

        }

    }

    public function patron_opening_balance_delete($id){


         //data taking opening balance
         $opening_balance = PatronOpeningBalance::where('id',$id)->first();
         $patron_id = $opening_balance->patron_id;
 
        // DB::table('patron_opening_balance')->delete();
 
         //$voucher = Voucher::where('opening_balance',1)->delete();
         //$voucher_debit = VoucherDebit::where('opening_balance',1)->delete();
         //$voucher_credit = VoucherCredit::where('opening_balance',1)->delete();
         //return redirect()->back();
 
 
         
          //data taking voucher
         $voucher = Voucher::where('sub_account_id',$patron_id)->where('opening_balance',1)->first();
         $voucher_id = $voucher->id; 
 
         $voucher_debit_delete = VoucherDebit::where('voucher_id',$voucher_id)->where('opening_balance',1)->delete();
         $voucher_credit_delete = VoucherCredit::where('voucher_id',$voucher_id)->where('opening_balance',1)->delete();
         $voucher_delete = Voucher::where('sub_account_id',$patron_id)->where('opening_balance',1)->delete();
         $delete = PatronOpeningBalance::where('patron_id',$patron_id)->delete();
 
        return redirect()->back()->with('success','Data Deleted Successfully');
    }

    
}
