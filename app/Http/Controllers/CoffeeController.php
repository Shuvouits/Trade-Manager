<?php

namespace App\Http\Controllers;

use App\Models\CoffeeExpense;
use App\Models\CoffeeIncome;
use App\Models\HR;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CoffeeController extends Controller
{
    public function AddIncome()
    {
        $all_hr = HR::where('status', 'on')->get();
        return view('coffee.addIncome', compact('all_hr'));
    }

    public function AddExpenses()
    {
        $all_hr = HR::where('status', 'on')->get();
        return view('coffee.addExpenses', compact('all_hr'));
    }

    public function CoffeeExpensePost(Request $request)
    {

        $date = date('Y-m-d', strtotime($request->input('date')));
        $element = $request->input('element');
        $amount = $request->input('amount');



        $coffee_expenses = new CoffeeExpense();
        $coffee_expenses->date = $date;
        $coffee_expenses->element = $element;
        $coffee_expenses->amount = $amount;

        $coffee_expenses->save();
        return redirect()->back()->with('success', 'Data Added Successfully');
    }

    public function CoffeeIncomePost(Request $request)
    {

        $date = date('Y-m-d', strtotime($request->input('date')));
        $user_id = $request->input('user_id');
        $amount = $request->input('amount');
        $quantity = $request->input('quantity');

        //date store session
        Session::put('session_income_date_data', $request->input('date'));



        $coffee_expenses = new CoffeeIncome();
        $coffee_expenses->date = $date;
        $coffee_expenses->user_id = $user_id;
        $coffee_expenses->amount = $amount;
        $coffee_expenses->quantity = $quantity;

        $coffee_expenses->save();
        return redirect()->back()->with('success', 'New Data Inserted Successfully');
    }

    public function ProfitLoss()
    {
        $now = Carbon::now();

        $current_month_income = DB::table('coffee_incomes')
            ->join('hr', 'hr.id', '=', 'coffee_incomes.user_id')
            ->select('hr.name', DB::raw('MAX(coffee_incomes.user_id) as user_id'), DB::raw('SUM(coffee_incomes.amount) as total_amount'), DB::raw('SUM(coffee_incomes.quantity) as total_quantity'))
            ->whereYear('date', $now->year)
            ->whereMonth('date', $now->month)
            ->groupBy('hr.name')
            ->get();


        $current_month = Carbon::now()->month;

         $current_month_history = DB::table('coffee_incomes')
            ->join('hr', 'hr.id', '=', 'coffee_incomes.user_id')
            ->select('coffee_incomes.*', 'hr.name' )
            ->whereMonth('date', $current_month)
            ->get();
         

        $coffee_expenses = CoffeeExpense::whereMonth('date', $current_month)->get();

        $total_amount_coffee_income = CoffeeIncome::whereMonth('date', $current_month)->sum('amount');

        $total_amount_coffee_expenses = CoffeeExpense::whereMonth('date', $current_month)->sum('amount');


        return view('coffee.profitLoss', compact('current_month_income', 'current_month_history', 'coffee_expenses', 'total_amount_coffee_expenses','total_amount_coffee_income'));
    }  

    public function IncomeFilterPost(Request $request){

        $start_date = date('Y-m-d', strtotime($request->input('start_date')));
        $finished_date = date('Y-m-d', strtotime($request->input('finished_date')));  

        $filter_month_income = DB::table('coffee_incomes')
        ->join('hr', 'hr.id', '=', 'coffee_incomes.user_id')
        ->select('hr.name', DB::raw('MAX(coffee_incomes.user_id) as user_id'), DB::raw('SUM(coffee_incomes.amount) as total_amount'), DB::raw('SUM(coffee_incomes.quantity) as total_quantity'))
        ->whereBetween('date', [$start_date, $finished_date])
        ->groupBy('hr.name')
        ->get();

        $filter_month_history = DB::table('coffee_incomes')
        ->join('hr', 'hr.id', '=', 'coffee_incomes.user_id')
        ->select('coffee_incomes.*', 'hr.name' )
        ->whereBetween('date', [$start_date, $finished_date])
        ->get(); 

        $coffee_expenses = CoffeeExpense::whereBetween('date', [$start_date, $finished_date])->get();

        $total_amount_coffee_income = CoffeeIncome::whereBetween('date', [$start_date, $finished_date] )->sum('amount');

        $total_amount_coffee_expenses = CoffeeExpense::whereBetween('date', [$start_date, $finished_date])->sum('amount');

        return view('coffee.filterProfitLoss', compact('filter_month_income', 'filter_month_history', 'coffee_expenses', 'total_amount_coffee_expenses','total_amount_coffee_income', 'start_date', 'finished_date'));

    }
}
