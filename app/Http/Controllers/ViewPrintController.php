<?php

namespace App\Http\Controllers;

use App\Models\Auth;
use App\Models\BalanceSheet;
use App\Models\Bank;
use App\Models\ChartChild;
use App\Models\ChartParent;
use App\Models\HR;
use App\Models\HrRecord;
use App\Models\JobRecord;
use App\Models\LedgerController;
use App\Models\OpeningBalance;
use App\Models\PatronCategory;
use App\Models\PatronDetails;
use App\Models\PatronOpeningBalance;
use App\Models\PayrollBreakupBasic;
use App\Models\Position;
use App\Models\ProfitLossAccount;
use App\Models\TradingAccount;
use App\Models\TransactionMode;
use App\Models\TrialBalance;
use App\Models\Voucher;
use App\Models\VoucherCredit;
use App\Models\VoucherDebit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;


use PDF;


class ViewPrintController extends Controller
{

    public function payroll_sheet()
    {
        return view('view-print.payroll-sheet');
    }

    public function payroll_sheet_post(Request $request)
    {


        $validator = Validator::make($request->all(), [

            'company_name' => 'required',
            'date_start' => 'required',
            'date_finished' => 'required',


        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $date_start = date('Y-m-d', strtotime($request->input('date_start')));
            $date_finished = date('Y-m-d', strtotime($request->input('date_finished')));


            $job_record = JobRecord::where('date', $date_start)->where('date', $date_finished)->get();
            $job_record_total = JobRecord::where('date', $date_start)->where('date', $date_finished)->sum('due_net_payroll');
            $hr = HR::all();
            $position = Position::all();


            return view('view-print.payroll-sheet-view', compact('job_record', 'hr', 'position', 'date_start', 'date_finished', 'job_record_total'));
        }
    }

    public function payroll_sheet_till_date()
    {
        return view('view-print.payroll-sheet-till-date');
    }

    public function payroll_sheet_till_date_post(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'company_name' => 'required',
            'date_start' => 'required',
            'date_finished' => 'required',


        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $date_start = $request->input('date_start');
            $date_finished = $request->input('date_finished');

            $job_record = JobRecord::whereBetween('date', [$date_start, $date_finished])->get();
            $job_record_total = JobRecord::whereBetween('date', [$date_start, $date_finished])->sum('due_net_payroll');
            $hr = HR::all();
            $position = Position::all();

            return view('view-print.payroll-sheet-view', compact('job_record', 'hr', 'position', 'date_start', 'date_finished', 'job_record_total'));
        }
    }

    public function hr_account()
    {
        $hr = HR::all();
        return view('view-print.hr-account', compact('hr'));
    }

    public function hr_account_post(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'company_name' => 'required',

            'date_start' => 'required',
            'date_finished' => 'required',
            'hr' => 'required'


        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $company_name = $request->input('company_name');
            $hr = $request->input('hr');
            $date_start = $request->input('date_start');
            $date_finished = $request->input('date_finished');

            $job_record = JobRecord::where('hr', $hr)->whereBetween('date', [$date_start, $date_finished])->get();
            $job_record_total = JobRecord::where('hr', $hr)->whereBetween('date', [$date_start, $date_finished])->sum('due_net_payroll');
            $hr_data = HR::all();

            $hr_record = HrRecord::where('hr', $hr)->get();

            return view('view-print.hr-account-view', compact('date_start', 'date_finished', 'job_record', 'job_record_total', 'hr_data', 'hr_record'));
        }
    }

    public function journal()
    {
        return view('view-print.journal');
    }

    public function journal_view()
    {
        $voucher = Voucher::all();
        $voucher_credit = VoucherCredit::all();
        $voucher_debit = VoucherDebit::all();
        $chart_child = ChartChild::all();
        $patron_details = PatronDetails::all();
        $bank = Bank::all();
        $transaction_mode = TransactionMode::all();

        return view('view-print.journal-view', compact('voucher', 'voucher_credit', 'voucher_debit', 'chart_child', 'patron_details', 'bank', 'transaction_mode'));
    }

    public function journal_post(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'company_name' => 'required',
            'date_start' => 'required',
            'date_finished' => 'required',


        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $date_start = date('Y-m-d', strtotime($request->input('date_start')));

            $date_finished = date('Y-m-d', strtotime($request->input('date_finished')));;


            $voucher = Voucher::whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->orderBY('date', 'ASC')->get();

            $voucher_debit = VoucherDebit::whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->get();
            $voucher_credit = VoucherCredit::whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->get();

            $patron_details = PatronDetails::all();
            $patron_category = PatronCategory::all();
            $hr = HR::all();

            return view('view-print.journal-view', compact('voucher', 'voucher_debit', 'voucher_credit', 'date_start', 'date_finished', 'patron_details', 'patron_category', 'hr'));
        }
    }

    public function journal_specific()
    {
        $patron = PatronDetails::all();
        return view('view-print.journal-specific', compact('patron'));
    }

    public function journal_specific_post(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'company_name' => 'required',
            'date_start' => 'required',
            'date_finished' => 'required',
            'patron_id' => 'required',


        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $date_start = $request->input('date_start');
            $date_finished = $request->input('date_finished');
            $patron_id = $request->input('patron_id');

            $voucher = Voucher::where('sub_account_id', $patron_id)->whereBetween('date', [$date_start, $date_finished])->get();
            $voucher_credit = VoucherCredit::whereBetween('date', [$date_start, $date_finished])->get();
            $voucher_debit = VoucherDebit::whereBetween('date', [$date_start, $date_finished])->get();

            return view('view-print.journal-view', compact('voucher', 'voucher_debit', 'voucher_credit', 'date_start', 'date_finished'));
        }
    }

    public function ledger()
    {
        $ledger_controller = LedgerController::where('ledger_type', '0')->get();
        return view('view-print.ledger', compact('ledger_controller'));
    }

    public function ledger_post(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'company_name' => 'required',
            'date_start' => 'required',
            'date_finished' => 'required',


        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $company_name = $request->input('company_name');
            $date_start = date('Y-m-d', strtotime($request->input('date_start')));
            $date_finished = date('Y-m-d', strtotime($request->input('date_finished')));
            $account_id = $request->input('account_id');



            //$voucher = Voucher::where('account_id', $account_id)->orWhere('additional_account', $account_id)->whereBetween('created_at', [$date_start, $date_finished])->get();
            $voucher = Voucher::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->orWhere('additional_account', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->get();


            $voucher_debit = VoucherDebit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->orWhere('additional_account', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->get();
            $voucher_credit = VoucherCredit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->orWhere('additional_account', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->get();

            $sum_voucher_debit = VoucherDebit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->orWhere('additional_account', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->sum('amount');
            $sum_voucher_credit = VoucherCredit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->orWhere('additional_account', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->sum('amount');

            $voucher_purpose = ChartChild::where('id', $account_id)->first();
            $purpose = $voucher_purpose->name;

            session()->put('purpose', $purpose);

            //opening balance data 

            $opening_balance = OpeningBalance::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->first();

            if ($opening_balance != "") {
                $debit_balance = $opening_balance->debit_balance;
                $credit_balance = $opening_balance->credit_balance;
                $date = $opening_balance->date;

                $opening_balance_data = $debit_balance - $credit_balance;
                $balance_dr =  $opening_balance_data + ($sum_voucher_debit - $sum_voucher_credit);
            } else {



                $date = $date_start;





                $opening_balance = OpeningBalance::where('account_id', $account_id)->first();
                $debit_balance = $opening_balance->debit_balance;
                $credit_balance = $opening_balance->credit_balance;
                $main_opening_balance = $debit_balance - $credit_balance;


                $perfect_start_date = date('Y-m-d', strtotime('-1 month', strtotime($date_start)));
                $perfect_finished_date = date('Y-m-t', strtotime($perfect_start_date));




                $sum_voucher_debit_opening = VoucherDebit::where('account_id', $account_id)->whereBetween('date', ['2023-01-01', $perfect_finished_date])->where('opening_balance', NULL)->orWhere('additional_account', $account_id)->whereBetween('date', ['2023-01-01', $perfect_finished_date])->where('opening_balance', NULL)->sum('amount');
                $sum_voucher_credit_opening = VoucherCredit::where('account_id', $account_id)->whereBetween('date', ['2023-01-01', $perfect_finished_date])->where('opening_balance', NULL)->orWhere('additional_account', $account_id)->whereBetween('date', ['2023-01-01', $perfect_finished_date])->where('opening_balance', NULL)->sum('amount');



                $opening_balance_data = $main_opening_balance + ($sum_voucher_debit_opening - $sum_voucher_credit_opening);

                $sum_voucher_debit = VoucherDebit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->orWhere('additional_account', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->sum('amount');

                $sum_voucher_credit = VoucherCredit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->orWhere('additional_account', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->sum('amount');

                $balance_dr =  $opening_balance_data + ($sum_voucher_debit - $sum_voucher_credit);
            }


            //End opening balance data


            return view('view-print.ledger-view', compact('voucher', 'date_start', 'date_finished', 'voucher_debit', 'voucher_credit', 'sum_voucher_debit', 'sum_voucher_credit', 'purpose', 'account_id', 'debit_balance', 'credit_balance', 'date', 'balance_dr', 'opening_balance_data'));
        }
    }

    public function ledger_controller()
    {
        $chart_child = ChartChild::all();
        return view('view-print.ledger-controller', compact('chart_child'));
    }

    public function ledger_controller_post(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'company_name' => 'required',
            'ledger_type' => 'required',
            'account_id' => 'required',

        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $ledger_type = $request->input('ledger_type');
            $account_id = $request->input('account_id');

            $chart_child = ChartChild::where('id', $account_id)->first();
            $account_name = $chart_child->name;

            $ledger_controller = new LedgerController();
            $ledger_controller->ledger_type = $ledger_type;
            $ledger_controller->account_id = $account_id;
            $ledger_controller->account_name = $account_name;
            $ledger_controller->save();

            return redirect()->back()->with('success', 'Data Inserted Successfully');
        }
    }

    public function ledger_patron()
    {
        $patron = PatronDetails::all();
        return view('view-print.ledger-patron', compact('patron'));
    }

    public function ledger_patron_post(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'company_name' => 'required',
            'date_start' => 'required',
            'date_finished' => 'required',
            'patron_id' => 'required',

        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {



            $company_name = $request->input('company_name');
            $date_start = date('Y-m-d', strtotime($request->input('date_start')));
            $date_finished = date('Y-m-d', strtotime($request->input('date_finished')));
            $patron_id = $request->input('patron_id');

            $account_id = $patron_id;





            $voucher = Voucher::where('sub_account_id', $patron_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->get();
            $voucher_debit = VoucherDebit::where('sub_account_id', $patron_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->get();
            $voucher_credit = VoucherCredit::where('sub_account_id', $patron_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->get();

            $sum_voucher_debit = VoucherDebit::where('sub_account_id', $patron_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance',  NULL)->sum('amount');
            $sum_voucher_credit = VoucherCredit::where('sub_account_id', $patron_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->sum('amount');

            $patron = PatronDetails::where('id', $patron_id)->first();
            $purpose = $patron->patron_name;

            session()->put('purpose', $purpose);

            $opening_count = PatronOpeningBalance::where('patron_id', $patron_id)->count();

            if ($opening_count == 0) {
                if ($date_start == '2023-01-01') {
                    $date = $date_start;

                    $debit_balance = 0;
                    $credit_balance = 0;
                    $opening_balance_data = 0;
                    $balance_dr =  $opening_balance_data + ($sum_voucher_debit - $sum_voucher_credit);
                } else {
                    $date = $date_start;
                    $debit_balance = 0;
                    $credit_balance = 0;

                    $perfect_start_date = date('Y-m-d', strtotime('-1 month', strtotime($date_start)));
                    $perfect_finished_date = date('Y-m-t', strtotime($perfect_start_date));

                    $sum_voucher_debit_opening = VoucherDebit::where('sub_account_id', $patron_id)->whereBetween('date', ['2023-01-01', $perfect_finished_date])->where('opening_balance', NULL)->sum('amount');
                    $sum_voucher_credit_opening = VoucherCredit::where('sub_account_id', $patron_id)->whereBetween('date', ['2023-01-01', $perfect_finished_date])->where('opening_balance', NULL)->sum('amount');

                    $opening_balance_data = ($sum_voucher_debit_opening - $sum_voucher_credit_opening);



                    $sum_voucher_debit = VoucherDebit::where('sub_account_id', $patron_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->sum('amount');
                    $sum_voucher_credit = VoucherCredit::where('sub_account_id', $patron_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->sum('amount');

                    $balance_dr =  $opening_balance_data + ($sum_voucher_debit - $sum_voucher_credit);
                }
            }

            if ($opening_count == 1) {

                //opening balance data 

                $opening_balance = PatronOpeningBalance::where('patron_id', $patron_id)->whereBetween('date', [$date_start, $date_finished])->first();


                if ($opening_balance != "") {
                    $debit_balance = $opening_balance->debit_balance;
                    $credit_balance = $opening_balance->credit_balance;
                    $date = $opening_balance->date;

                    $opening_balance_data = $debit_balance - $credit_balance;
                    $balance_dr =  $opening_balance_data + ($sum_voucher_debit - $sum_voucher_credit);
                } else {

                    $date = $date_start;

                    $opening_balance = PatronOpeningBalance::where('patron_id', $patron_id)->first();
                    $debit_balance = $opening_balance->debit_balance;
                    $credit_balance = $opening_balance->credit_balance;
                    $main_opening_balance = $debit_balance - $credit_balance;




                    $perfect_start_date = date('Y-m-d', strtotime('-1 month', strtotime($date_start)));
                    $perfect_finished_date = date('Y-m-t', strtotime($perfect_start_date));


                    $sum_voucher_debit_opening = VoucherDebit::where('sub_account_id', $patron_id)->whereBetween('date', ['2023-01-01', $perfect_finished_date])->where('opening_balance', NULL)->sum('amount');
                    $sum_voucher_credit_opening = VoucherCredit::where('sub_account_id', $patron_id)->whereBetween('date', ['2023-01-01', $perfect_finished_date])->where('opening_balance', NULL)->sum('amount');



                    $opening_balance_data = $main_opening_balance + ($sum_voucher_debit_opening - $sum_voucher_credit_opening);

                    $sum_voucher_debit = VoucherDebit::where('sub_account_id', $patron_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->sum('amount');
                    $sum_voucher_credit = VoucherCredit::where('sub_account_id', $patron_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->sum('amount');

                    $balance_dr =  $opening_balance_data + ($sum_voucher_debit - $sum_voucher_credit);
                }


                //End opening balance data

            }






            return view('view-print.ledger-view', compact('voucher', 'date_start', 'date_finished', 'voucher_debit', 'voucher_credit', 'sum_voucher_debit', 'sum_voucher_credit', 'purpose', 'patron_id', 'debit_balance', 'credit_balance', 'date', 'account_id', 'balance_dr', 'opening_balance_data'));
        }
    }

    public function ledger_bank()
    {
        $bank = Bank::all();
        return view('view-print.ledger-bank', compact('bank'));
    }

    public function ledger_bank_post(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'company_name' => 'required',
            'date_start' => 'required',
            'date_finished' => 'required',
            'bank_id' => 'required',

        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $company_name = $request->input('company_name');
            $date_start = date('Y-m-d', strtotime($request->input('date_start')));
            $date_finished = date('Y-m-d', strtotime($request->input('date_finished')));
            $bank_id = $request->input('bank_id');

            $voucher = Voucher::where('bank_id', $bank_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->get();

            $voucher_debit = VoucherDebit::where('bank_id', $bank_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->get();
            $voucher_credit = VoucherCredit::where('bank_id', $bank_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->get();


            $sum_voucher_debit = VoucherDebit::where('bank_id', $bank_id)->whereNull('opening_balance')->whereBetween('date', [$date_start, $date_finished])->sum('amount');

            $sum_voucher_credit = VoucherCredit::where('bank_id', $bank_id)->whereNull('opening_balance')->whereBetween('date', [$date_start, $date_finished])->sum('amount');

            $bank = Bank::where('id', $bank_id)->first();
            $purpose = $bank->bank_name;

            session()->put('purpose', $purpose);

            $account_id = 0;

            //opening balance data 


            $opening_balance = OpeningBalance::where('bank_id', $bank_id)->whereBetween('date', [$date_start, $date_finished])->first();

            if ($opening_balance != "") {
                $debit_balance = $opening_balance->debit_balance;
                $credit_balance = $opening_balance->credit_balance;
                $date = $opening_balance->date;

                $opening_balance_data = $debit_balance - $credit_balance;
                $balance_dr =  $opening_balance_data + ($sum_voucher_debit - $sum_voucher_credit);
            } else {


                $date = $date_start;

                $opening_balance = OpeningBalance::where('bank_id', $bank_id)->first();
                $debit_balance = $opening_balance->debit_balance;
                $credit_balance = $opening_balance->credit_balance;
                $main_opening_balance = $debit_balance - $credit_balance;


                $perfect_start_date = date('Y-m-d', strtotime('-1 month', strtotime($date_start)));
                $perfect_finished_date = date('Y-m-t', strtotime($perfect_start_date));


                $sum_voucher_debit_opening = VoucherDebit::where('bank_id', $bank_id)->whereBetween('date', ['2023-01-01', $perfect_finished_date])->where('opening_balance', NULL)->sum('amount');
                $sum_voucher_credit_opening = VoucherCredit::where('bank_id', $bank_id)->whereBetween('date', ['2023-01-01', $perfect_finished_date])->where('opening_balance', NULL)->sum('amount');

                $opening_balance_data = $main_opening_balance + ($sum_voucher_debit_opening - $sum_voucher_credit_opening);

                $sum_voucher_debit = VoucherDebit::where('bank_id', $bank_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->sum('amount');
                $sum_voucher_credit = VoucherCredit::where('bank_id', $bank_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->sum('amount');

                $balance_dr =  $opening_balance_data + ($sum_voucher_debit - $sum_voucher_credit);
            }


            //End opening balance data

            return view('view-print.ledger-view', compact('voucher', 'date_start', 'date_finished', 'voucher_debit', 'voucher_credit', 'sum_voucher_debit', 'sum_voucher_credit', 'purpose', 'account_id', 'debit_balance', 'credit_balance', 'date', 'balance_dr', 'opening_balance_data'));
        }
    }

    public function ledger_income()
    {
        $ledger_controller = LedgerController::where('ledger_type', 1)->get();
        return view('view-print.ledger-income', compact('ledger_controller'));
    }

    public function ledger_income_post(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'company_name' => 'required',
            'date_start' => 'required',
            'date_finished' => 'required',
            'account_id' => 'required',

        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $company_name = $request->input('company_name');
            $date_start = date('Y-m-d', strtotime($request->input('date_start')));
            $date_finished = date('Y-m-d', strtotime($request->input('date_finished')));
            $account_id = $request->input('account_id');


            $voucher = Voucher::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->orWhere('additional_account', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->get();
            $voucher_debit = VoucherDebit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->orWhere('additional_account', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->get();
            $voucher_credit = VoucherCredit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->orWhere('additional_account', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->get();

            $sum_voucher_debit = VoucherDebit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->orWhere('additional_account', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->sum('amount');
            $sum_voucher_credit = VoucherCredit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->orWhere('additional_account', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->sum('amount');


            $voucher_purpose = ChartChild::where('id', $account_id)->first();
            $purpose = $voucher_purpose->name;

            session()->put('purpose', $purpose);


            //opening balance data 


            $opening_balance = OpeningBalance::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->first();

            if ($opening_balance != "") {
                $debit_balance = $opening_balance->debit_balance;
                $credit_balance = $opening_balance->credit_balance;

                $date = $opening_balance->date;

                $opening_balance_data = $debit_balance - $credit_balance;
                $balance_dr =  $opening_balance_data + ($sum_voucher_debit - $sum_voucher_credit);
            } else {



                $date = $date_start;




                $opening_balance = OpeningBalance::where('account_id', $account_id)->first();
                $debit_balance = $opening_balance->debit_balance;
                $credit_balance = $opening_balance->credit_balance;
                $main_opening_balance = $debit_balance - $credit_balance;




                $perfect_start_date = date('Y-m-d', strtotime('-1 month', strtotime($date_start)));

                $perfect_finished_date = date('Y-m-t', strtotime($perfect_start_date));






                $sum_voucher_debit_opening = VoucherDebit::where('account_id', $account_id)->whereBetween('date', ['2023-01-01', $perfect_finished_date])->where('opening_balance', NULL)->orWhere('additional_account', $account_id)->whereBetween('date', ['2023-01-01', $perfect_finished_date])->where('opening_balance', NULL)->sum('amount');


                $sum_voucher_credit_opening = VoucherCredit::where('account_id', $account_id)->whereBetween('date', ['2023-01-01', $perfect_finished_date])->where('opening_balance', NULL)->orWhere('additional_account', $account_id)->whereBetween('date', ['2023-01-01', $perfect_finished_date])->where('opening_balance', NULL)->sum('amount');





                $opening_balance_data = $main_opening_balance + ($sum_voucher_debit_opening - $sum_voucher_credit_opening);




                $sum_voucher_debit = VoucherDebit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->orWhere('additional_account', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->sum('amount');
                $sum_voucher_credit = VoucherCredit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->orWhere('additional_account', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->sum('amount');

                $balance_dr =  $opening_balance_data + ($sum_voucher_debit - $sum_voucher_credit);
            }


            //End opening balance data

            return view('view-print.ledger-view', compact('voucher', 'date_start', 'date_finished', 'voucher_debit', 'voucher_credit', 'sum_voucher_debit', 'sum_voucher_credit', 'purpose', 'account_id', 'debit_balance', 'credit_balance', 'date', 'balance_dr', 'opening_balance_data'));
        }
    }

    public function ledger_cash()
    {
        return view('view-print.ledger-cash');
    }

    public function ledger_cash_post(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'company_name' => 'required',
            'date_start' => 'required',
            'date_finished' => 'required',


        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $date_start = date('Y-m-d', strtotime($request->input('date_start')));
            $date_finished = date('Y-m-d', strtotime($request->input('date_finished')));



            $voucher = Voucher::where('transaction_mode', '1')->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->get();
            $voucher_debit = VoucherDebit::where('transaction_mode', '1')->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->get();
            $voucher_credit = VoucherCredit::where('transaction_mode', '1')->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->get();

            $sum_voucher_debit = VoucherDebit::where('transaction_mode', 1)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->sum('amount');
            $sum_voucher_credit = VoucherCredit::where('transaction_mode', 1)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->sum('amount');

            $purpose = "Cash";

            session()->put('purpose', $purpose);

            $account_id = 0;


            //opening balance data 
            $opening_balance = OpeningBalance::whereBetween('date', [$date_start, $date_finished])->where('account_id', '81')->first();


            if ($opening_balance != "") {
                $debit_balance = $opening_balance->debit_balance;
                $credit_balance = $opening_balance->credit_balance;
                $date = $opening_balance->date;

                $opening_balance_data = $debit_balance - $credit_balance;
                $balance_dr =  $opening_balance_data + ($sum_voucher_debit - $sum_voucher_credit);
            } else {

                $date = $date_start;

                $opening_balance = OpeningBalance::where('account_id', '81')->first();
                $debit_balance = $opening_balance->debit_balance;
                $credit_balance = $opening_balance->credit_balance;
                $main_opening_balance = $debit_balance - $credit_balance;


                $perfect_start_date = date('Y-m-d', strtotime('-1 month', strtotime($date_start)));

                $perfect_finished_date = date('Y-m-t', strtotime($perfect_start_date));




                $sum_voucher_debit_opening = VoucherDebit::where('transaction_mode', 1)->whereBetween('date', ['2023-01-01', $perfect_finished_date])->where('opening_balance', NULL)->sum('amount');

                $sum_voucher_credit_opening = VoucherCredit::where('transaction_mode', 1)->whereBetween('date', ['2023-01-01', $perfect_finished_date])->where('opening_balance', NULL)->sum('amount');


                $opening_balance_data = $main_opening_balance + ($sum_voucher_debit_opening - $sum_voucher_credit_opening);



                $sum_voucher_debit = VoucherDebit::where('transaction_mode', 1)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->sum('amount');
                $sum_voucher_credit = VoucherCredit::where('transaction_mode', 1)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->sum('amount');

                $balance_dr =  $opening_balance_data + ($sum_voucher_debit - $sum_voucher_credit);
            }

            //End opening balance data

            return view('view-print.ledger-view', compact('voucher', 'date_start', 'date_finished', 'voucher_debit', 'voucher_credit', 'sum_voucher_debit', 'sum_voucher_credit', 'purpose', 'account_id', 'debit_balance', 'credit_balance', 'date', 'balance_dr', 'opening_balance_data'));
        }
    }

    public function accounts_journal_delete(Request $request)
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

            //check voucher date
            $voucher_count = Voucher::where('id', $id)->where('date', $date)->count();



            $auth_count = Auth::where('password', $password)->count();

            if ($auth_count > 0 && $voucher_count > 0) {

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
                    return redirect('/view-print/journal')->with('success', 'Data Deleted Successfully');
                } else if ($account_id == 115) {
                    //Payroll & wages Payable

                    $hr_record = HrRecord::where('date', $date)->delete();
                    $voucher = Voucher::where('id', $id)->delete();
                    $voucher_debit = VoucherDebit::where('voucher_id', $id)->delete();
                    $voucher_credit = VoucherCredit::where('voucher_id', $id)->delete();
                    return redirect('/view-print/journal')->with('success', 'Data Deleted Successfully');
                } else if ($account_id == 111) {
                    //Advance Payroll 

                    $hr_record = HrRecord::where('date', $date)->where('hr', $hr_id)->delete();
                    $voucher = Voucher::where('id', $id)->delete();
                    $voucher_debit = VoucherDebit::where('voucher_id', $id)->delete();
                    $voucher_credit = VoucherCredit::where('voucher_id', $id)->delete();

                    $payroll_breakup_basic = PayrollBreakupBasic::where('hr', $hr_id)->first();
                    $payroll_breakup_basic->advance_salary = 0;
                    $payroll_breakup_basic->save();
                    return redirect('/view-print/journal')->with('success', 'Data Deleted Successfully');
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
                    return redirect('/view-print/journal')->with('success', 'Data Deleted Successfully');
                } else {

                    $voucher = Voucher::where('id', $id)->delete();
                    $voucher_debit = VoucherDebit::where('voucher_id', $id)->delete();
                    $voucher_credit = VoucherCredit::where('voucher_id', $id)->delete();
                    return redirect('/view-print/journal')->with('success', 'Data Deleted Successfully');
                }
            } else {
                return redirect('/view-print/journal')->with('error', "Error Data Couldn't Deleted");
            }
        }
    }

    public function trial_balance()
    {
        return view('view-print.trial-balance');
    }

    public function trial_balance_post(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'company_name' => 'required',
            'date_start' => 'required',
            'date_finished' => 'required',


        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {



            DB::table('trial_balance')->delete();
            $date_start = date('Y-m-d', strtotime($request->input('date_start')));
            $date_finished = date('Y-m-d', strtotime($request->input('date_finished')));






            $voucher_count = Voucher::whereBetween('date', [$date_start, $date_finished])->count();

            for ($i = 0; $i < $voucher_count; $i++) {
                $voucher = Voucher::whereBetween('date', [$date_start, $date_finished])->get();
                $voucher_id = $voucher[$i]->id;

                $account_id = $voucher[$i]->account_id;
                $account_name = $voucher[$i]->account_name;

                $additional_account = $voucher[$i]->additional_account;
                $additional_account_name = $voucher[$i]->additional_account_name;

                $transaction_mode = $voucher[$i]->transaction_mode;

                if ($transaction_mode == 2) {
                    $transaction_mode_name = 'bank';

                    $trial_balance_transaction_mode_count = TrialBalance::where('transaction_mode', $transaction_mode)->count();

                    if ($trial_balance_transaction_mode_count == 0) {
                        $trial_balance = new TrialBalance();

                        $trial_balance->accounts_name = $transaction_mode_name;
                        $trial_balance->transaction_mode = $transaction_mode;

                        $trial_balance->save();
                    }
                } else if ($transaction_mode == 1) {
                    $transaction_mode_name = 'cash';

                    $trial_balance_transaction_mode_count = TrialBalance::where('transaction_mode', $transaction_mode)->count();

                    if ($trial_balance_transaction_mode_count == 0) {
                        $trial_balance = new TrialBalance();
                        $trial_balance->accounts_name = $transaction_mode_name;
                        $trial_balance->transaction_mode = $transaction_mode;

                        $trial_balance->save();
                    }
                }



                //account_id
                $trial_balance_account_id_count = TrialBalance::where('account_id', $account_id)->count();


                if ($trial_balance_account_id_count == 0) {
                    $trial_balance = new TrialBalance();
                    $trial_balance->accounts_name = $account_name;
                    $trial_balance->account_id = $account_id;
                    $trial_balance->save();
                }
                //end account_id





                //additional account_id 


                $trial_balance_additional_account_id_count = TrialBalance::where('account_id', $additional_account)->count();
                if ($trial_balance_additional_account_id_count == 0) {

                    $trial_balance = new TrialBalance();
                    $trial_balance->accounts_name = $additional_account_name;
                    $trial_balance->account_id = $additional_account;

                    $trial_balance->save();
                }

                //End additional account_id


            }



            //purpose of account dr & cr update
            $trial_balance_count = TrialBalance::count();
            for ($i = 0; $i < $trial_balance_count; $i++) {
                $trial_balance = TrialBalance::all();
                $account_id = $trial_balance[$i]->account_id;
                $transaction_mode = $trial_balance[$i]->transaction_mode;

                //account id & additional-account-id purpose

                $voucher_debit_sum = VoucherDebit::where('account_id', $account_id)->where('account_id', '!=', 'NULL')->whereBetween('date', [$date_start, $date_finished])->sum('amount');

                $voucher_credit_sum = VoucherCredit::where('account_id', $account_id)->where('account_id', '!=', 'NULL')->whereBetween('date', [$date_start, $date_finished])->sum('amount');

                $voucher_debit_additional = VoucherDebit::where('additional_account', $account_id)->where('additional_account', '!=', 'NULL')->whereBetween('date', [$date_start, $date_finished])->sum('amount');
                $voucher_credit_additional = VoucherCredit::where('additional_account', $account_id)->where('additional_account', '!=', 'NULL')->whereBetween('date', [$date_start, $date_finished])->sum('amount');




                $debit_amount = $voucher_debit_sum + $voucher_debit_additional;
                $credit_amount = $voucher_credit_sum + $voucher_credit_additional;

                $update_trial_balance_account = TrialBalance::where('account_id', $account_id)->where('account_id', '!=', 'NULL')->first();

                if ($update_trial_balance_account != '') {
                    $update_trial_balance_account->dr = $debit_amount;
                    $update_trial_balance_account->cr = $credit_amount;
                    $update_trial_balance_account->save();
                }

                //transaction purpose update
                $voucher_debit_sum_transaction = VoucherDebit::where('transaction_mode', $transaction_mode)->where('transaction_mode', '!=', 'NULL')->whereBetween('date', [$date_start, $date_finished])->sum('amount');
                $voucher_credit_sum_transaction = VoucherCredit::where('transaction_mode', $transaction_mode)->where('transaction_mode', '!=', 'NULL')->whereBetween('date', [$date_start, $date_finished])->sum('amount');



                $update_trial_balance_transaction = TrialBalance::where('transaction_mode', $transaction_mode)->where('transaction_mode', '!=', 'NULL')->first();

                if ($update_trial_balance_transaction != '') {
                    $update_trial_balance_transaction->dr =  $voucher_debit_sum_transaction;
                    $update_trial_balance_transaction->cr = $voucher_credit_sum_transaction;
                    $update_trial_balance_transaction->save();
                }

                //purpose of account final_dr & final_cr update
                $update_trial_balance_final = TrialBalance::where('account_id', $account_id)->where('account_id', '!=', 'NULL')->first();

                if ($update_trial_balance_final != '') {
                    $dr = $update_trial_balance_final->dr;
                    $cr = $update_trial_balance_final->cr;

                    //purpose for Negative Number

                    if ($dr < 0) {
                        $final_dr = $dr;
                        $update_trial_balance_final->final_dr = $final_dr;
                        $update_trial_balance_final->save();
                    } else if ($cr < 0) {
                        $final_cr = $cr;
                        $update_trial_balance_final->final_cr = $final_cr;
                        $update_trial_balance_final->save();
                    }


                    //purpose for Negative Number End

                    if ($dr >= 0 && $cr >= 0) {

                        if ($dr > $cr) {
                            $final_dr = $dr - $cr;
                            $update_trial_balance_final->final_dr = $final_dr;
                            $update_trial_balance_final->save();
                        } else if ($cr > $dr) {
                            $final_cr = $cr - $dr;
                            $update_trial_balance_final->final_cr = $final_cr;
                            $update_trial_balance_final->save();
                        }
                    }
                }

                //purpose of account final_dr & final_cr update transaction purpose

                $update_trial_balance_final_transaction = TrialBalance::where('transaction_mode', $transaction_mode)->where('transaction_mode', '!=', 'NULL')->first();

                if ($update_trial_balance_final_transaction != '') {
                    $dr = $update_trial_balance_final_transaction->dr;
                    $cr = $update_trial_balance_final_transaction->cr;

                    //purpose for Negative Number

                    if ($dr < 0) {
                        $final_dr = $dr;
                        $update_trial_balance_final_transaction->final_dr = $final_dr;
                        $update_trial_balance_final_transaction->save();
                    } else if ($cr < 0) {
                        $final_cr = $cr;
                        $update_trial_balance_final_transaction->final_cr = $final_cr;
                        $update_trial_balance_final_transaction->save();
                    }

                    //purpose for Negative Number End



                    //purpose of account final_dr & final_cr update transaction purpose



                    if ($dr >= 0 && $cr >= 0) {
                        if ($dr > $cr) {
                            $final_dr = $dr - $cr;
                            $update_trial_balance_final_transaction->final_dr = $final_dr;
                            $update_trial_balance_final_transaction->save();
                        } else if ($cr > $dr) {

                            $final_cr = $cr - $dr;

                            $update_trial_balance_final_transaction->final_cr = $final_cr;
                            $update_trial_balance_final_transaction->save();
                        }
                    }
                }
            }
            //end


            //just clean and start transaction
            $delete_bank_id = TrialBalance::where('account_id', 83)->delete();
            $delete_bank_transaction = TrialBalance::where('transaction_mode', 2)->delete();

            $voucher_debit_payoneer = VoucherDebit::where('bank_id', 4)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
            $voucher_credit_payoneer = VoucherCredit::where('bank_id', 4)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
            $payoneer_data = $voucher_debit_payoneer -  $voucher_credit_payoneer;


            $voucher_debit_paypal = VoucherDebit::where('bank_id', 3)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
            $voucher_credit_paypal = VoucherCredit::where('bank_id', 3)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
            $paypal_data = $voucher_debit_paypal -  $voucher_credit_paypal;


            $voucher_debit_brac = VoucherDebit::where('bank_id', 2)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
            $voucher_credit_brac = VoucherCredit::where('bank_id', 2)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
            $brac_data = $voucher_debit_brac -  $voucher_credit_brac;


            $voucher_debit_dutchBangla = VoucherDebit::where('bank_id', 5)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
            $voucher_credit_dutchBangla = VoucherCredit::where('bank_id', 5)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
            $dutchBangla_data = $voucher_debit_dutchBangla -  $voucher_credit_dutchBangla;




            $total_data = ($payoneer_data + $paypal_data + $brac_data + $dutchBangla_data);



            $trial_balance_bank_entry = new TrialBalance();
            $trial_balance_bank_entry->account_id = 83;
            $trial_balance_bank_entry->accounts_name = "Bank";
            $trial_balance_bank_entry->dr = 0;
            $trial_balance_bank_entry->cr = 0;

            if ($total_data > 0) {
                $trial_balance_bank_entry->final_dr = $total_data;
            }

            if ($total_data < 0) {
                $total_data = 0 - $total_data;
                $trial_balance_bank_entry->final_cr = $total_data;
            }

            $trial_balance_bank_entry->save();

            //cash clean

            $delete_bank_id = TrialBalance::where('account_id', 81)->delete();
            $delete_bank_transaction = TrialBalance::where('transaction_mode', 1)->delete();

            $voucher_debit_cash = VoucherDebit::where('account_id', 81)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
            $voucher_debit_transaction = VoucherDebit::where('transaction_mode', 1)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
            $debit_cash = $voucher_debit_cash +  $voucher_debit_transaction;

            $voucher_credit_cash = VoucherCredit::where('account_id', 81)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
            $voucher_credit_transaction = VoucherCredit::where('transaction_mode', 1)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
            $credit_cash =  $voucher_credit_cash +  $voucher_credit_transaction;

            $total_cash = ($debit_cash - $credit_cash);

            $trial_balance_cash_entry = new TrialBalance();
            $trial_balance_cash_entry->account_id = 81;
            $trial_balance_cash_entry->accounts_name = "Cash";
            $trial_balance_cash_entry->dr = 0;
            $trial_balance_cash_entry->cr = 0;

            if ($total_cash > 0) {
                $trial_balance_cash_entry->final_dr = $total_cash;
            }

            if ($total_cash < 0) {
                $total_cash = 0 - $total_cash;
                $trial_balance_cash_entry->final_cr = $total_cash;
            }

            $trial_balance_cash_entry->save();



            //end clean procedure



            $trial_balance_debit = TrialBalance::where('final_dr', '!=', 'NULL')->get();
            $trial_balance_debit_count = TrialBalance::where('final_dr', '!=', 'NULL')->count();
            $trial_balance_credit = TrialBalance::where('final_cr', '!=', 'NULL')->get();
            $total_dr = TrialBalance::sum('final_dr');
            $total_cr = TrialBalance::sum('final_cr');


            return view('view-print.trial-balance-view', compact('date_start', 'date_finished', 'trial_balance_debit', 'trial_balance_credit', 'total_dr', 'total_cr', 'trial_balance_debit_count'));
        }
    }

    public function trial_balance_pdf_view($date_start, $date_finished)
    {

        $date_start = date('Y-m-d', strtotime($date_start));
        $date_finished = date('Y-m-d', strtotime($date_finished));


        DB::table('trial_balance')->delete();
        $date_start = date('Y-m-d', strtotime($date_start));
        $date_finished = date('Y-m-d', strtotime($date_finished));



        $voucher_count = Voucher::whereBetween('date', [$date_start, $date_finished])->count();

        for ($i = 0; $i < $voucher_count; $i++) {
            $voucher = Voucher::whereBetween('date', [$date_start, $date_finished])->get();
            $voucher_id = $voucher[$i]->id;

            $account_id = $voucher[$i]->account_id;
            $account_name = $voucher[$i]->account_name;

            $additional_account = $voucher[$i]->additional_account;
            $additional_account_name = $voucher[$i]->additional_account_name;

            $transaction_mode = $voucher[$i]->transaction_mode;

            if ($transaction_mode == 2) {
                $transaction_mode_name = 'bank';

                $trial_balance_transaction_mode_count = TrialBalance::where('transaction_mode', $transaction_mode)->count();

                if ($trial_balance_transaction_mode_count == 0) {
                    $trial_balance = new TrialBalance();

                    $trial_balance->accounts_name = $transaction_mode_name;
                    $trial_balance->transaction_mode = $transaction_mode;

                    $trial_balance->save();
                }
            } else if ($transaction_mode == 1) {
                $transaction_mode_name = 'cash';

                $trial_balance_transaction_mode_count = TrialBalance::where('transaction_mode', $transaction_mode)->count();

                if ($trial_balance_transaction_mode_count == 0) {
                    $trial_balance = new TrialBalance();
                    $trial_balance->accounts_name = $transaction_mode_name;
                    $trial_balance->transaction_mode = $transaction_mode;

                    $trial_balance->save();
                }
            }



            //account_id
            $trial_balance_account_id_count = TrialBalance::where('account_id', $account_id)->count();


            if ($trial_balance_account_id_count == 0) {
                $trial_balance = new TrialBalance();
                $trial_balance->accounts_name = $account_name;
                $trial_balance->account_id = $account_id;
                $trial_balance->save();
            }
            //end account_id





            //additional account_id 


            $trial_balance_additional_account_id_count = TrialBalance::where('account_id', $additional_account)->count();
            if ($trial_balance_additional_account_id_count == 0) {

                $trial_balance = new TrialBalance();
                $trial_balance->accounts_name = $additional_account_name;
                $trial_balance->account_id = $additional_account;

                $trial_balance->save();
            }

            //End additional account_id


        }



        //purpose of account dr & cr update
        $trial_balance_count = TrialBalance::count();
        for ($i = 0; $i < $trial_balance_count; $i++) {
            $trial_balance = TrialBalance::all();
            $account_id = $trial_balance[$i]->account_id;
            $transaction_mode = $trial_balance[$i]->transaction_mode;

            //account id & additional-account-id purpose

            $voucher_debit_sum = VoucherDebit::where('account_id', $account_id)->where('account_id', '!=', 'NULL')->whereBetween('date', [$date_start, $date_finished])->sum('amount');

            $voucher_credit_sum = VoucherCredit::where('account_id', $account_id)->where('account_id', '!=', 'NULL')->whereBetween('date', [$date_start, $date_finished])->sum('amount');

            $voucher_debit_additional = VoucherDebit::where('additional_account', $account_id)->where('additional_account', '!=', 'NULL')->whereBetween('date', [$date_start, $date_finished])->sum('amount');
            $voucher_credit_additional = VoucherCredit::where('additional_account', $account_id)->where('additional_account', '!=', 'NULL')->whereBetween('date', [$date_start, $date_finished])->sum('amount');




            $debit_amount = $voucher_debit_sum + $voucher_debit_additional;
            $credit_amount = $voucher_credit_sum + $voucher_credit_additional;

            $update_trial_balance_account = TrialBalance::where('account_id', $account_id)->where('account_id', '!=', 'NULL')->first();

            if ($update_trial_balance_account != '') {
                $update_trial_balance_account->dr = $debit_amount;
                $update_trial_balance_account->cr = $credit_amount;
                $update_trial_balance_account->save();
            }

            //transaction purpose update
            $voucher_debit_sum_transaction = VoucherDebit::where('transaction_mode', $transaction_mode)->where('transaction_mode', '!=', 'NULL')->whereBetween('date', [$date_start, $date_finished])->sum('amount');
            $voucher_credit_sum_transaction = VoucherCredit::where('transaction_mode', $transaction_mode)->where('transaction_mode', '!=', 'NULL')->whereBetween('date', [$date_start, $date_finished])->sum('amount');



            $update_trial_balance_transaction = TrialBalance::where('transaction_mode', $transaction_mode)->where('transaction_mode', '!=', 'NULL')->first();

            if ($update_trial_balance_transaction != '') {
                $update_trial_balance_transaction->dr =  $voucher_debit_sum_transaction;
                $update_trial_balance_transaction->cr = $voucher_credit_sum_transaction;
                $update_trial_balance_transaction->save();
            }

            //purpose of account final_dr & final_cr update
            $update_trial_balance_final = TrialBalance::where('account_id', $account_id)->where('account_id', '!=', 'NULL')->first();

            if ($update_trial_balance_final != '') {
                $dr = $update_trial_balance_final->dr;
                $cr = $update_trial_balance_final->cr;

                //purpose for Negative Number

                if ($dr < 0) {
                    $final_dr = $dr;
                    $update_trial_balance_final->final_dr = $final_dr;
                    $update_trial_balance_final->save();
                } else if ($cr < 0) {
                    $final_cr = $cr;
                    $update_trial_balance_final->final_cr = $final_cr;
                    $update_trial_balance_final->save();
                }


                //purpose for Negative Number End

                if ($dr >= 0 && $cr >= 0) {

                    if ($dr > $cr) {
                        $final_dr = $dr - $cr;
                        $update_trial_balance_final->final_dr = $final_dr;
                        $update_trial_balance_final->save();
                    } else if ($cr > $dr) {
                        $final_cr = $cr - $dr;
                        $update_trial_balance_final->final_cr = $final_cr;
                        $update_trial_balance_final->save();
                    }
                }
            }

            //purpose of account final_dr & final_cr update transaction purpose

            $update_trial_balance_final_transaction = TrialBalance::where('transaction_mode', $transaction_mode)->where('transaction_mode', '!=', 'NULL')->first();

            if ($update_trial_balance_final_transaction != '') {
                $dr = $update_trial_balance_final_transaction->dr;
                $cr = $update_trial_balance_final_transaction->cr;

                //purpose for Negative Number

                if ($dr < 0) {
                    $final_dr = $dr;
                    $update_trial_balance_final_transaction->final_dr = $final_dr;
                    $update_trial_balance_final_transaction->save();
                } else if ($cr < 0) {
                    $final_cr = $cr;
                    $update_trial_balance_final_transaction->final_cr = $final_cr;
                    $update_trial_balance_final_transaction->save();
                }

                //purpose for Negative Number End



                //purpose of account final_dr & final_cr update transaction purpose



                if ($dr >= 0 && $cr >= 0) {
                    if ($dr > $cr) {
                        $final_dr = $dr - $cr;
                        $update_trial_balance_final_transaction->final_dr = $final_dr;
                        $update_trial_balance_final_transaction->save();
                    } else if ($cr > $dr) {

                        $final_cr = $cr - $dr;

                        $update_trial_balance_final_transaction->final_cr = $final_cr;
                        $update_trial_balance_final_transaction->save();
                    }
                }
            }
        }
        //end


        //just clean and start transaction
        $delete_bank_id = TrialBalance::where('account_id', 83)->delete();
        $delete_bank_transaction = TrialBalance::where('transaction_mode', 2)->delete();

        $voucher_debit_payoneer = VoucherDebit::where('bank_id', 4)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
        $voucher_credit_payoneer = VoucherCredit::where('bank_id', 4)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
        $payoneer_data = $voucher_debit_payoneer -  $voucher_credit_payoneer;


        $voucher_debit_paypal = VoucherDebit::where('bank_id', 3)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
        $voucher_credit_paypal = VoucherCredit::where('bank_id', 3)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
        $paypal_data = $voucher_debit_paypal -  $voucher_credit_paypal;


        $voucher_debit_brac = VoucherDebit::where('bank_id', 2)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
        $voucher_credit_brac = VoucherCredit::where('bank_id', 2)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
        $brac_data = $voucher_debit_brac -  $voucher_credit_brac;


        $voucher_debit_dutchBangla = VoucherDebit::where('bank_id', 5)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
        $voucher_credit_dutchBangla = VoucherCredit::where('bank_id', 5)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
        $dutchBangla_data = $voucher_debit_dutchBangla -  $voucher_credit_dutchBangla;




        $total_data = ($payoneer_data + $paypal_data + $brac_data + $dutchBangla_data);



        $trial_balance_bank_entry = new TrialBalance();
        $trial_balance_bank_entry->account_id = 83;
        $trial_balance_bank_entry->accounts_name = "Bank";
        $trial_balance_bank_entry->dr = 0;
        $trial_balance_bank_entry->cr = 0;

        if ($total_data > 0) {
            $trial_balance_bank_entry->final_dr = $total_data;
        }

        if ($total_data < 0) {
            $total_data = 0 - $total_data;
            $trial_balance_bank_entry->final_cr = $total_data;
        }

        $trial_balance_bank_entry->save();

        //cash clean

        $delete_bank_id = TrialBalance::where('account_id', 81)->delete();
        $delete_bank_transaction = TrialBalance::where('transaction_mode', 1)->delete();

        $voucher_debit_cash = VoucherDebit::where('account_id', 81)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
        $voucher_debit_transaction = VoucherDebit::where('transaction_mode', 1)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
        $debit_cash = $voucher_debit_cash +  $voucher_debit_transaction;

        $voucher_credit_cash = VoucherCredit::where('account_id', 81)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
        $voucher_credit_transaction = VoucherCredit::where('transaction_mode', 1)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
        $credit_cash =  $voucher_credit_cash +  $voucher_credit_transaction;

        $total_cash = ($debit_cash - $credit_cash);

        $trial_balance_cash_entry = new TrialBalance();
        $trial_balance_cash_entry->account_id = 81;
        $trial_balance_cash_entry->accounts_name = "Cash";
        $trial_balance_cash_entry->dr = 0;
        $trial_balance_cash_entry->cr = 0;

        if ($total_cash > 0) {
            $trial_balance_cash_entry->final_dr = $total_cash;
        }

        if ($total_cash < 0) {
            $total_cash = 0 - $total_cash;
            $trial_balance_cash_entry->final_cr = $total_cash;
        }

        $trial_balance_cash_entry->save();



        //end clean procedure



        $trial_balance_debit = TrialBalance::where('final_dr', '!=', 'NULL')->get();
        $trial_balance_debit_count = TrialBalance::where('final_dr', '!=', 'NULL')->count();
        $trial_balance_credit = TrialBalance::where('final_cr', '!=', 'NULL')->get();
        $total_dr = TrialBalance::sum('final_dr');
        $total_cr = TrialBalance::sum('final_cr');

       

        $data = [
            'date_start' => $date_start,
            'date_finished' => $date_finished,
            'trial_balance_debit' => $trial_balance_debit,
            'trial_balance_credit' => $trial_balance_credit,
            'total_dr' => $total_dr,
            'total_cr' => $total_cr,
            'trial_balance_debit_count' => $trial_balance_debit_count

            
        ];
        $pdf = PDF::loadView('view-print.trial-balance-pdf-view', $data);
        return $pdf->download('TrialBalance.pdf');



        //return view('view-print.trial-balance-pdf-view', compact('date_start', 'date_finished', 'trial_balance_debit', 'trial_balance_credit', 'total_dr', 'total_cr', 'trial_balance_debit_count'));
    }

    public function trading_account()
    {
        return view('view-print.trading-account');
    }

    public function trading_post(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'company_name' => 'required',
            'date_start' => 'required',
            'date_finished' => 'required',


        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            DB::table('trading_accounts')->delete();

            $date_start = date('Y-m-d', strtotime($request->input('date_start')));
            $date_finished = date('Y-m-d', strtotime($request->input('date_finished')));

            //Account_id & Account name insert value insert 

            $chart_chid_count = ChartChild::count();

            for ($i = 0; $i < $chart_chid_count; $i++) {
                $chart_child = ChartChild::all();

                $account_id = $chart_child[$i]->id;
                $account_name = $chart_child[$i]->name;
                $section = $chart_child[$i]->section;

                if ($section == 1) {
                    $trading_account = new TradingAccount();
                    $trading_account->account_id = $account_id;
                    $trading_account->account_name = $account_name;

                    $trading_account->save();
                }




                $voucher_debit = VoucherDebit::where('account_id', $account_id)->sum('amount');

                $voucher_credit = VoucherCredit::where('account_id', $account_id)->sum('amount');
            }

            //debit and credit value insert 

            $trading_account_count = TradingAccount::count();

            for ($i = 0; $i < $trading_account_count; $i++) {
                $trading_account = TradingAccount::all();

                $account_id = $trading_account[$i]->account_id;

                $voucher_debit = VoucherDebit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
                $voucher_credit = VoucherCredit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->sum('amount');

                $update_trading_account = TradingAccount::where('account_id', $account_id)->first();
                $update_trading_account->dr = $voucher_debit;
                $update_trading_account->cr = $voucher_credit;
                $update_trading_account->save();
            }

            $trading_account_debit = TradingAccount::where('dr', '!=', 0)->get();
            $trading_account_credit = TradingAccount::where('cr', '!=', 0)->get();

            $trading_account_debit_sum = TradingAccount::where('dr', '!=', 0)->sum('dr');
            $trading_account_credit_sum = TradingAccount::where('cr', '!=', 0)->sum('cr');

            $gross_profit_sales = ($trading_account_credit_sum - $trading_account_debit_sum);

            $trading_account_all_data = TradingAccount::where('dr', '>', 0)->orWhere('cr', '>', 0)->get();


            return view('view-print.trading-account-view', compact('date_start', 'date_finished', 'trading_account_debit', 'trading_account_credit', 'trading_account_debit_sum', 'trading_account_credit_sum', 'trading_account_all_data'));
        }
    }

    public function profit_loss()
    {
        return view('view-print.profit-loss');
    }

    public function profit_loss_post(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'company_name' => 'required',
            'date_start' => 'required',
            'date_finished' => 'required',


        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            //start trading Account


            DB::table('trading_accounts')->delete();

            $date_start = date('Y-m-d', strtotime($request->input('date_start')));
            $date_finished = date('Y-m-d', strtotime($request->input('date_finished')));

            //Account_id & Account name insert value insert 

            $chart_chid_count = ChartChild::count();

            for ($i = 0; $i < $chart_chid_count; $i++) {
                $chart_child = ChartChild::all();

                $account_id = $chart_child[$i]->id;
                $account_name = $chart_child[$i]->name;
                $section = $chart_child[$i]->section;

                if ($section == 1) {
                    $trading_account = new TradingAccount();
                    $trading_account->account_id = $account_id;
                    $trading_account->account_name = $account_name;

                    $trading_account->save();
                }




                $voucher_debit = VoucherDebit::where('account_id', $account_id)->sum('amount');

                $voucher_credit = VoucherCredit::where('account_id', $account_id)->sum('amount');
            }

            //debit and credit value insert 

            $trading_account_count = TradingAccount::count();

            for ($i = 0; $i < $trading_account_count; $i++) {
                $trading_account = TradingAccount::all();
                $account_id = $trading_account[$i]->account_id;

                $voucher_debit = VoucherDebit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
                $voucher_credit = VoucherCredit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->sum('amount');

                $update_trading_account = TradingAccount::where('account_id', $account_id)->first();
                $update_trading_account->dr = $voucher_debit;
                $update_trading_account->cr = $voucher_credit;
                $update_trading_account->save();
            }

            $trading_account_debit = TradingAccount::where('dr', '!=', 0)->get();
            $trading_account_credit = TradingAccount::where('cr', '!=', 0)->get();

            $trading_account_debit_sum = TradingAccount::where('dr', '!=', 0)->sum('dr');
            $trading_account_credit_sum = TradingAccount::where('cr', '!=', 0)->sum('cr');

            $gross_profit_sales = ($trading_account_credit_sum - $trading_account_debit_sum);


            //start Profit & Loss

            DB::table('profit_loss_account')->delete();

            $date_start = date('Y-m-d', strtotime($request->input('date_start')));
            $date_finished = date('Y-m-d', strtotime($request->input('date_finished')));

            //Account_id & Account name insert value insert 

            $chart_chid_count = ChartChild::count();


            for ($i = 0; $i < $chart_chid_count; $i++) {
                $chart_child = ChartChild::all();

                $account_id = $chart_child[$i]->id;
                $account_name = $chart_child[$i]->name;
                $section = $chart_child[$i]->section;

                if ($section == 2) {
                    $profit_loss_account = new ProfitLossAccount();
                    $profit_loss_account->account_id = $account_id;
                    $profit_loss_account->account_name = $account_name;

                    $profit_loss_account->save();
                }




                $voucher_debit = VoucherDebit::where('account_id', $account_id)->sum('amount');

                $voucher_credit = VoucherCredit::where('account_id', $account_id)->sum('amount');
            }

            //debit and credit value insert 

            $profit_loss_account_count = ProfitLossAccount::count();

            for ($i = 0; $i < $profit_loss_account_count; $i++) {
                $profit_loss_account = ProfitLossAccount::all();
                $account_id = $profit_loss_account[$i]->account_id;

                $voucher_debit = VoucherDebit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
                $voucher_credit = VoucherCredit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->sum('amount');

                $update_profit_loss_account = ProfitLossAccount::where('account_id', $account_id)->first();
                $update_profit_loss_account->dr = $voucher_debit;
                $update_profit_loss_account->cr = $voucher_credit;
                $update_profit_loss_account->save();
            }

            //update gross profit &sales

            $Profit_loss_account = ProfitLossAccount::where('account_id', 55)->first();
            $Profit_loss_account->cr =  $gross_profit_sales;
            $Profit_loss_account->save();

            $profit_loss_account_debit = ProfitLossAccount::where('dr', '!=', 0)->get();
            $profit_loss_account_credit = ProfitLossAccount::where('cr', '!=', 0)->get();

            $profit_loss_account_debit_sum = ProfitLossAccount::where('dr', '!=', 0)->sum('dr');
            $profit_loss_account_credit_sum = ProfitLossAccount::where('cr', '!=', 0)->sum('cr');

            $profit_loss_total_data = ProfitLossAccount::where('dr', '>', 0)->orWhere('cr', '>', 0)->get();




            return view('view-print.profit-loss-view', compact('date_start', 'date_finished', 'profit_loss_account_debit', 'profit_loss_account_credit', 'profit_loss_account_debit_sum', 'profit_loss_account_credit_sum', 'profit_loss_total_data'));
        }
    }

    public function balance_sheet()
    {
        return view('view-print.balance-sheet');
    }

    public function balance_sheet_post(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'company_name' => 'required',
            'date_start' => 'required',
            'date_finished' => 'required',


        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            DB::table('balance_sheet')->delete();

            $date_start = date('Y-m-d', strtotime($request->input('date_start')));
            $date_finished = date('Y-m-d', strtotime($request->input('date_finished')));

            //Account_id & Account name insert value insert 

            $chart_chid_count = ChartChild::count();

            for ($i = 0; $i < $chart_chid_count; $i++) {
                $chart_child = ChartChild::all();

                $account_id = $chart_child[$i]->id;
                $account_name = $chart_child[$i]->name;
                $section = $chart_child[$i]->section;

                if ($section == 3 || $section == 4) {

                    $balance_sheet = new BalanceSheet();
                    $balance_sheet->account_id = $account_id;
                    $balance_sheet->account_name = $account_name;
                    $balance_sheet->section = $section;

                    $balance_sheet->save();
                }
            }

            //Asset Amount value insert 

            $asset_count = BalanceSheet::where('section', 3)->count();

            for ($i = 0; $i < $asset_count; $i++) {
                $asset_part = BalanceSheet::where('section', 3)->get();
                $account_id = $asset_part[$i]->account_id;

                if ($account_id == 81) {
                    $voucher_debit_account = VoucherDebit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
                    $voucher_credit_account = VoucherCredit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->sum('amount');

                    $voucher_debit_transaction = VoucherDebit::where('transaction_mode', 1)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
                    $voucher_credit_transaction = VoucherCredit::where('transaction_mode', 1)->whereBetween('date', [$date_start, $date_finished])->sum('amount');

                    if ($voucher_debit_account == '') {
                        $voucher_debit_account = 0;
                    } else if ($voucher_credit_account == '') {
                        $voucher_credit_account = 0;
                    } else if ($voucher_debit_transaction == '') {
                        $voucher_debit_transaction = 0;
                    } else if ($voucher_credit_transaction == '') {
                        $voucher_credit_transaction = 0;
                    }

                    $voucher_debit =  $voucher_debit_account +  $voucher_debit_transaction;
                    $voucher_credit =  $voucher_credit_account +  $voucher_credit_transaction;

                    if ($voucher_debit == '') {
                        $voucher_debit = 0;
                    } else if ($voucher_credit == '') {
                        $voucher_credit = 0;
                    }

                    $total_amount = $voucher_debit - $voucher_credit;



                    $update_balance_amount = BalanceSheet::where('account_id', $account_id)->first();
                    $update_balance_amount->amount = $total_amount;
                    $update_balance_amount->save();
                } else if ($account_id == 83) {

                    $voucher_debit_account = VoucherDebit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
                    $voucher_credit_account = VoucherCredit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->sum('amount');

                    $voucher_debit_transaction = VoucherDebit::where('transaction_mode', 2)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
                    $voucher_credit_transaction = VoucherCredit::where('transaction_mode', 2)->whereBetween('date', [$date_start, $date_finished])->sum('amount');

                    if ($voucher_debit_account == '') {
                        $voucher_debit_account = 0;
                    } else if ($voucher_credit_account == '') {
                        $voucher_credit_account = 0;
                    } else if ($voucher_debit_transaction == '') {
                        $voucher_debit_transaction = 0;
                    } else if ($voucher_credit_transaction == '') {
                        $voucher_credit_transaction = 0;
                    }

                    $voucher_debit =  $voucher_debit_account +  $voucher_debit_transaction;
                    $voucher_credit =  $voucher_credit_account +  $voucher_credit_transaction;

                    if ($voucher_debit == '') {
                        $voucher_debit = 0;
                    } else if ($voucher_credit == '') {
                        $voucher_credit = 0;
                    }

                    $total_amount = $voucher_debit - $voucher_credit;



                    $update_balance_amount = BalanceSheet::where('account_id', $account_id)->first();
                    $update_balance_amount->amount = $total_amount;
                    $update_balance_amount->save();
                } else {

                    $voucher_debit = VoucherDebit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->orWhere('additional_account', $account_id)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->sum('amount');
                    $voucher_credit = VoucherCredit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->sum('amount');

                    if ($voucher_debit == '') {
                        $voucher_debit = 0;
                    } else if ($voucher_credit == '') {
                        $voucher_credit = 0;
                    }

                    $total_amount = $voucher_debit - $voucher_credit;



                    $update_balance_amount = BalanceSheet::where('account_id', $account_id)->first();
                    $update_balance_amount->amount = $total_amount;
                    $update_balance_amount->save();
                }
            }

            //Equity Amount value insert 

            $equity_count = BalanceSheet::where('section', 4)->count();

            for ($i = 0; $i < $equity_count; $i++) {
                $equity_part = BalanceSheet::where('section', 4)->get();
                $account_id = $equity_part[$i]->account_id;

                $voucher_debit = VoucherDebit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
                $voucher_credit = VoucherCredit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->sum('amount');

                if ($voucher_debit == '') {
                    $voucher_debit = 0;
                } else if ($voucher_credit == '') {
                    $voucher_credit = 0;
                }

                $total_amount = $voucher_credit - $voucher_debit;



                $update_balance_amount = BalanceSheet::where('account_id', $account_id)->first();
                $update_balance_amount->amount = $total_amount;
                $update_balance_amount->save();
            }


            //update Capital adjustment for profit loss value

            //start trading Account


            DB::table('trading_accounts')->delete();

            $date_start = date('Y-m-d', strtotime($request->input('date_start')));
            $date_finished = date('Y-m-d', strtotime($request->input('date_finished')));

            //Account_id & Account name insert value insert 

            $chart_chid_count = ChartChild::count();

            for ($i = 0; $i < $chart_chid_count; $i++) {
                $chart_child = ChartChild::all();

                $account_id = $chart_child[$i]->id;
                $account_name = $chart_child[$i]->name;
                $section = $chart_child[$i]->section;

                if ($section == 1) {
                    $trading_account = new TradingAccount();
                    $trading_account->account_id = $account_id;
                    $trading_account->account_name = $account_name;

                    $trading_account->save();
                }




                $voucher_debit = VoucherDebit::where('account_id', $account_id)->sum('amount');

                $voucher_credit = VoucherCredit::where('account_id', $account_id)->sum('amount');
            }

            //debit and credit value insert 

            $trading_account_count = TradingAccount::count();

            for ($i = 0; $i < $trading_account_count; $i++) {
                $trading_account = TradingAccount::all();
                $account_id = $trading_account[$i]->account_id;

                $voucher_debit = VoucherDebit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
                $voucher_credit = VoucherCredit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->sum('amount');

                $update_trading_account = TradingAccount::where('account_id', $account_id)->first();
                $update_trading_account->dr = $voucher_debit;
                $update_trading_account->cr = $voucher_credit;
                $update_trading_account->save();
            }

            $trading_account_debit = TradingAccount::where('dr', '!=', 0)->get();
            $trading_account_credit = TradingAccount::where('cr', '!=', 0)->get();

            $trading_account_debit_sum = TradingAccount::where('dr', '!=', 0)->sum('dr');
            $trading_account_credit_sum = TradingAccount::where('cr', '!=', 0)->sum('cr');

            $gross_profit_sales = ($trading_account_credit_sum - $trading_account_debit_sum);


            //start Profit & Loss

            DB::table('profit_loss_account')->delete();

            $date_start = date('Y-m-d', strtotime($request->input('date_start')));
            $date_finished = date('Y-m-d', strtotime($request->input('date_finished')));

            //Account_id & Account name insert value insert 

            $chart_chid_count = ChartChild::count();


            for ($i = 0; $i < $chart_chid_count; $i++) {
                $chart_child = ChartChild::all();

                $account_id = $chart_child[$i]->id;
                $account_name = $chart_child[$i]->name;
                $section = $chart_child[$i]->section;

                if ($section == 2) {
                    $profit_loss_account = new ProfitLossAccount();
                    $profit_loss_account->account_id = $account_id;
                    $profit_loss_account->account_name = $account_name;

                    $profit_loss_account->save();
                }




                $voucher_debit = VoucherDebit::where('account_id', $account_id)->sum('amount');

                $voucher_credit = VoucherCredit::where('account_id', $account_id)->sum('amount');
            }

            //debit and credit value insert 

            $profit_loss_account_count = ProfitLossAccount::count();

            for ($i = 0; $i < $profit_loss_account_count; $i++) {
                $profit_loss_account = ProfitLossAccount::all();
                $account_id = $profit_loss_account[$i]->account_id;

                $voucher_debit = VoucherDebit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->sum('amount');
                $voucher_credit = VoucherCredit::where('account_id', $account_id)->whereBetween('date', [$date_start, $date_finished])->sum('amount');

                $update_profit_loss_account = ProfitLossAccount::where('account_id', $account_id)->first();
                $update_profit_loss_account->dr = $voucher_debit;
                $update_profit_loss_account->cr = $voucher_credit;
                $update_profit_loss_account->save();
            }

            //update gross profit &sales

            $Profit_loss_account = ProfitLossAccount::where('account_id', 55)->first();
            $Profit_loss_account->cr =  $gross_profit_sales;
            $Profit_loss_account->save();

            $profit_loss_account_debit = ProfitLossAccount::where('dr', '!=', 0)->get();
            $profit_loss_account_credit = ProfitLossAccount::where('cr', '!=', 0)->get();

            $profit_loss_account_debit_sum = ProfitLossAccount::where('dr', '!=', 0)->sum('dr');
            $profit_loss_account_credit_sum = ProfitLossAccount::where('cr', '!=', 0)->sum('cr');

            $proft_loss_amount = $profit_loss_account_credit_sum - $profit_loss_account_debit_sum;

            $update_capital_adjustment = BalanceSheet::where('account_id', 171)->first();
            $current_amount = $update_capital_adjustment->amount;

            $update_capital_adjustment->amount =  $proft_loss_amount +  $current_amount;

            $update_capital_adjustment->save();


            //End update Capital adjustment for profit loss value







            $balance_sheet = BalanceSheet::where('amount', '!=', 0)->get();

            $sum_asset = BalanceSheet::where('section', 3)->sum('amount');
            $sum_equity = BalanceSheet::where('section', 4)->sum('amount');



            return view('view-print.balance-sheet-view', compact('date_start', 'date_finished', 'balance_sheet', 'sum_asset', 'sum_equity'));
        }
    }

    public function export_data($start_date, $finished_date)
    {

        $date_start = date('Y-m-d', strtotime($start_date));
        $date_finished = date('Y-m-d', strtotime($finished_date));


        $job_record = JobRecord::where('date', $date_start)->where('date', $date_finished)->get();
        $job_record_total = JobRecord::where('date', $date_start)->where('date', $date_finished)->sum('due_net_payroll');
        $hr = HR::all();
        $position = Position::all();
        //return view('view-print.pdf.payroll-sheet', compact('job_record', 'job_record_total', 'hr', 'position', 'date_start', 'date_finished'));


        $pdf = PDF::loadView('view-print.pdf.payroll-sheet', compact('job_record', 'job_record_total', 'hr', 'position', 'date_start', 'date_finished'));
        return $pdf->download('payroll-sheet.pdf');

        //$excel = EXCEL::loadView('view-print.pdf.payroll-sheet',compact('job_record', 'job_record_total', 'hr', 'position', 'date_start', 'date_finished'));

        //return $excel->download('payroll-sheet.xlsx');
    }

    public function export_cash_data($start_date, $finished_date)
    {

        $date_start = date('Y-m-d', strtotime($start_date));
        $date_finished = date('Y-m-d', strtotime($finished_date));




        $voucher = Voucher::where('transaction_mode', '1')->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->get();
        $voucher_debit = VoucherDebit::where('transaction_mode', '1')->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->get();
        $voucher_credit = VoucherCredit::where('transaction_mode', '1')->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->get();

        $sum_voucher_debit = VoucherDebit::where('transaction_mode', 1)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->sum('amount');
        $sum_voucher_credit = VoucherCredit::where('transaction_mode', 1)->whereBetween('date', [$date_start, $date_finished])->where('opening_balance', NULL)->sum('amount');

        //$purpose = "Cash";

        $account_id = 0;

        //opening balance data 
        $opening_balance = OpeningBalance::whereBetween('date', [$date_start, $date_finished])->where('account_id', '81')->first();



        if ($opening_balance != "") {
            $debit_balance = $opening_balance->debit_balance;
            $credit_balance = $opening_balance->credit_balance;
            $date = $opening_balance->date;
        } else {
            $debit_balance = 0;
            $credit_balance = 0;
            $date = "";
        }



        //return view('view-print.pdf.cash-ledger', compact('voucher', 'date_start', 'date_finished', 'voucher_debit', 'voucher_credit', 'sum_voucher_debit', 'sum_voucher_credit', 'account_id', 'debit_balance', 'credit_balance', 'date'));

        $pdf = PDF::loadView('view-print.pdf.cash-ledger', compact('voucher', 'date_start', 'date_finished', 'voucher_debit', 'voucher_credit', 'sum_voucher_debit', 'sum_voucher_credit', 'account_id', 'debit_balance', 'credit_balance', 'date'));
        return $pdf->download('cash-ledger.pdf');
    }
}
