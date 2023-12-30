<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\CoffeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InitialController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ViewPrintController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [AuthController::class, 'auth']);
Route::post('/auth-post', [AuthController::class, 'auth_post']);


Route::group(['middleware' => ['AdminAuth'], ], function(){
    Route::get('/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('/profile', [DashboardController::class, 'profile']);
    Route::post('/update-profile', [DashboardController::class, 'update_profile']);
    Route::get('/logout', [DashboardController::class, 'logout']);

});

Route::group(['middleware' => ['AdminAuth'], 'prefix'=>'coffee'], function(){
    Route::get('/add-income', [CoffeeController::class, 'AddIncome']);
    Route::get('/add-expenses', [CoffeeController::class, 'AddExpenses']);
    Route::post('/coffee-expense-post', [CoffeeController::class, 'CoffeeExpensePost']);
    Route::post('/coffee-income-post', [CoffeeController::class, 'CoffeeIncomePost']);
    Route::get('/profit-loss', [CoffeeController::class, 'ProfitLoss']);
    Route::post('/income-filter-post', [CoffeeController::class, 'IncomeFilterPost'] );

});



Route::group(['middleware' => ['AdminAuth'], 'prefix'=>'accounts' ], function(){

    Route::get('/receive-voucher', [AccountsController::class, 'receive_voucher']);
    Route::post('/cash-post', [AccountsController::class, 'cash_post']);
    Route::post('/sub-account-id', [AccountsController::class, 'sub_account_id']);
    Route::post('/bank-post', [AccountsController::class, 'bank_post']);
    Route::post('/credit-post', [AccountsController::class, 'credit_post']);
    Route::post('/dues-post', [AccountsController::class, 'dues_post']);
    Route::get('/payment-voucher', [AccountsController::class, 'payment_voucher']);

    Route::post('/payment-cash-post', [AccountsController::class, 'payment_cash_post']);
    Route::post('/payment-bank-post', [AccountsController::class, 'payment_bank_post']);
    Route::post('/payment-credit-post', [AccountsController::class, 'payment_credit_post']);
    Route::post('/payment-dues-post', [AccountsController::class, 'payment_dues_post']);

    Route::post('/payment-voucher-post', [AccountsController::class, 'payment_voucher_post']);

    Route::post('/receive-voucher-post', [AccountsController::class, 'receive_voucher_post']);
    Route::get('/adjust-account', [AccountsController::class, 'adjust_account']);
    Route::post('/adjust-account-post', [AccountsController::class, 'adjust_account_post']);
    Route::get('/adjust-account-history', [AccountsController::class, 'adjust_account_history']);
    Route::post('/journal/delete', [AccountsController::class, 'journal_delete']);
    Route::get('/opening-balance', [AccountsController::class, 'opening_balance']);
    Route::post('/opening-balance', [AccountsController::class, 'opening_balance_post']);
    Route::get('/opening-balance/{id}', [AccountsController::class, 'opening_balance_data_delete']);
    Route::get('/payment-voucher-view', [AccountsController::class, 'payment_voucher_view']);
    Route::get('/receive-voucher-view', [AccountsController::class, 'receive_voucher_view']); 
    Route::get('/other-account', [AccountsController::class, 'other_account']); 
    Route::post('/other-account-bank-post', [AccountsController::class, 'other_account_bank_post']);
    Route::post('/other-account-all-post', [AccountsController::class, 'other_account_all_post']);
    Route::post('/other-account', [AccountsController::class, 'other_account_post']);
    Route::get('/patron-opening-balance', [AccountsController::class, 'patron_opening_balance']);
    Route::post('/patron-opening-balance', [AccountsController::class, 'patron_opening_balance_post']);
    Route::get('/patron-opening-balance-delete/{id}', [AccountsController::class, 'patron_opening_balance_delete']);
    

});


Route::group(['middleware' => ['AdminAuth'], 'prefix'=>'payroll' ], function(){

    Route::get('/job-record', [PayrollController::class, 'job_record']);
    Route::get('/payroll-preparation', [PayrollController::class, 'payroll_preparation']);
    Route::post('/job-record', [PayrollController::class, 'job_record_post']);
    Route::get('/job-record-history', [PayrollController::class, 'job_record_history']);
    Route::post('/payroll-preparation-post', [PayrollController::class, 'payroll_preparation_post']);
    Route::get('/wage-distribution', [PayrollController::class, 'wage_distribution']);
    Route::get('/payroll-preparation-history', [PayrollController::class, 'payroll_preparation_history']);
    Route::post('/payroll-distribution', [PayrollController::class, 'payroll_distribution']);
    Route::post('/wage-distribution-payroll-ajax', [PayrollController::class, 'payroll_ajax']);
    Route::get('/job-record-history/delete/{id}', [PayrollController::class, 'job_record_history_delete']);
    


});


Route::group(['middleware' => ['AdminAuth'], 'prefix'=>'chart-account' ], function(){

    Route::get('/account-summery', [ChartController::class, 'account_summery']);
    Route::get('/parent-account', [ChartController::class, 'parent_account']);
    Route::post('/parent-account', [ChartController::class, 'parent_account_post']);
    Route::get('/main-account', [ChartController::class, 'main_account']);
    Route::post('/main-account', [ChartController::class, 'main_account_post']);
    Route::get('/child-account', [ChartController::class, 'child_account']);
    Route::post('/api/fetch-data', [ChartController::class, 'fetch_data']);
    Route::post('/child-account', [ChartController::class, 'child_account_post']);
    Route::get('/transaction-mode', [ChartController::class, 'transaction_mode']);
    Route::post('/transaction-mode-post', [ChartController::class, 'transaction_mode_post']);
    Route::get('/transaction-mode-view', [ChartController::class, 'transaction_mode_view']);
    Route::get('/transaction-mode-edit', [ChartController::class, 'transaction_mode_edit']);

    Route::get('/transaction-mode-edit/{id}', [ChartController::class, 'transaction_mode_edit_data']);
    Route::post('/transaction-mode-update', [ChartController::class, 'transaction_mode_update']);

    Route::get('/transaction-mode-delete/{id}', [ChartController::class, 'transaction_mode_delete']);
    Route::get('/account-management', [ChartController::class, 'account_management']);
    Route::post('/account-management-post', [ChartController::class, 'account_management_post']);
    Route::get('/account-summery-pdf', [ChartController::class, 'account_summery_pdf']);

});




Route::group([ 'middleware'=>['AdminAuth'], 'prefix' => 'initial'], function(){

    Route::get('/project', [InitialController::class, 'project']);
    Route::get('/patron-category', [InitialController::class, 'patron_category']);
    Route::post('/patron-status-add', [InitialController::class, 'patron_status']);
    Route::post('/patron-category-add', [InitialController::class, 'patron_category_add']);
    Route::get('/patron-status-view', [InitialController::class, 'patron_status_view']);
    Route::post('/api/fetch-data', [InitialController::class, 'fetch_data']);
    Route::post('/patron-details-post', [InitialController::class, 'patron_details_post']);
    Route::get('/patron-details', [InitialController::class, 'patron_details']);
    Route::get('/project-type', [InitialController::class, 'project_type']);
    Route::post('/project-type-post', [InitialController::class, 'project_type_post']);
    Route::get('/patron-details-view', [InitialController::class, 'patron_details_view']);
    Route::get('/project-type-view', [InitialController::class, 'project_type_view']);
    Route::post('/api/project', [InitialController::class, 'api_project']);
    Route::post('/project', [InitialController::class, 'project_post']);
    Route::get('/project-details-view', [InitialController::class, 'project_details_view']);
    Route::get('/bank', [InitialController::class, 'bank']);
    Route::post('/bank-post', [InitialController::class, 'bank_post']);
    Route::get('/bank-details-view', [InitialController::class, 'bank_details_view']);
    Route::get('/department-position', [InitialController::class, 'department_position']);
    Route::get('/department-position/add', [InitialController::class, 'department_position_add']);
    Route::post('/department-position/add', [InitialController::class, 'department_position_add_post']);
    Route::post('/department-position', [InitialController::class, 'department_position_post']);
    Route::get('/department-position-view', [InitialController::class, 'department_position_view']);
    Route::get('/human-resource', [InitialController::class, 'human_resource']);
    Route::post('/human-resource', [InitialController::class, 'human_resource_post']);
    Route::get('/human-resource-view/edit/{id}', [InitialController::class, 'human_resource_view_edit']);
    Route::get('/human-resource-view/delete/{id}', [InitialController::class, 'human_resource_view_delete']);
    Route::post('/human-resource-update', [InitialController::class, 'human_resource_update']);

    Route::post('/api/hr', [InitialController::class, 'api_hr']);
    Route::get('/human-resource-view', [InitialController::class, 'human_resource_view']);
    Route::get('/payroll-breakup-add', [InitialController::class, 'payroll_breakup_add']);
    Route::post('/api/payroll-breakup', [InitialController::class, 'api_payroll_breakup']);
    Route::get('/payroll-breakup-basic', [InitialController::class, 'payroll_breakup_basic']);
    Route::post('/payroll-breakup-basic', [InitialController::class, 'payroll_breakup_basic_post']);
   // Route::post('payroll-breakup-add', [InitialController::class, 'payroll_breakup_add']);
   Route::post('/payroll-breakup-basic/delete', [InitialController::class, 'payroll_breakup_basic_delete']);
    Route::get('/payroll-breakup-view', [InitialController::class, 'payroll_breakup_view']);
    Route::post('/payroll-breakup-add-post', [InitialController::class, 'payroll_breakup_add_post']);
    Route::get('/payroll-breakup-deduction', [InitialController::class, 'payroll_breakup_deduction']);
    Route::post('/payroll-breakup-deduction-post', [InitialController::class, 'payroll_breakup_deduction_post']);
    Route::post('/human-resource/status', [InitialController::class, 'human_resource_status_ajax']);
    Route::post('/edit-payroll-breakup-basic', [InitialController::class, 'edit_payroll_breakup_basic']);
    Route::get('/patron-details-view-delete/{id}', [InitialController::class, 'patron_details_view_delete']);
   
    
});





Route::group([ 'middleware'=>['AdminAuth'],  'prefix' => 'view-print'], function(){

    Route::get('/payroll-sheet', [ViewPrintController::class, 'payroll_sheet']);
    Route::post('/payroll-sheet-post', [ViewPrintController::class, 'payroll_sheet_post']);
    Route::get('/payroll-sheet-till-date', [ViewPrintController::class, 'payroll_sheet_till_date']);
    Route::post('/payroll-sheet-till-date', [ViewPrintController::class, 'payroll_sheet_till_date_post']);
    Route::get('/hr-account', [ViewPrintController::class, 'hr_account']);
    Route::post('/hr-account', [ViewPrintController::class, 'hr_account_post']);

    Route::get('/journal', [ViewPrintController::class, 'journal']);
    //Route::get('/journal-view', [ViewPrintController::class, 'journal_view']);

    Route::get('/journal-specific', [ViewPrintController::class, 'journal_specific']);
    Route::post('/journal-specific-post', [ViewPrintController::class, 'journal_specific_post']);

    Route::post('/journal-post', [ViewPrintController::class, 'journal_post']);

    Route::get('/ledger', [ViewPrintController::class, 'ledger']);
    Route::post('/ledger-post', [ViewPrintController::class, 'ledger_post']);
    Route::get('/ledger-controller', [ViewPrintController::class, 'ledger_controller']);
    Route::post('/ledger-controller-post', [ViewPrintController::class, 'ledger_controller_post']);

    Route::get('/ledger-patron', [ViewPrintController::class, 'ledger_patron']);
    Route::post('/ledger-patron-post', [ViewPrintController::class, 'ledger_patron_post']);

    Route::get('/ledger-bank', [ViewPrintController::class, 'ledger_bank']);

    Route::post('/ledger-bank-post', [ViewPrintController::class, 'ledger_bank_post']);
    Route::get('/ledger-income', [ViewPrintController::class, 'ledger_income']);
    Route::post('/ledger-income-post', [ViewPrintController::class, 'ledger_income_post']);
    Route::get('/ledger-cash', [ViewPrintController::class, 'ledger_cash']);
    Route::post('/ledger-cash-post', [ViewPrintController::class, 'ledger_cash_post']);
    Route::post('/accounts/journal/delete', [ViewPrintController::class, 'accounts_journal_delete']);
    Route::get('/balance', [ViewPrintController::class, 'trial_balance']);
    Route::post('/trial-balance-post', [ViewPrintController::class, 'trial_balance_post']);
    Route::get('/trading-account', [ViewPrintController::class, 'trading_account']);
    Route::post('/trading-post', [ViewPrintController::class, 'trading_post']);
    Route::get('/profit-loss', [ViewPrintController::class, 'profit_loss']); 
    Route::post('/profit-loss-post', [ViewPrintController::class, 'profit_loss_post']); 
    Route::get('/balance-sheet', [ViewPrintController::class, 'balance_sheet']); 
    Route::post('/balance-sheet-post', [ViewPrintController::class, 'balance_sheet_post']);

    Route::get('/export-data/{start_date}/{finished_date}', [ViewPrintController::class, 'export_data']);

    Route::get('/export-cash/{start_date}/{finished_date}', [ViewPrintController::class, 'export_cash_data']);
    Route::get('/trial-balance-pdf/{date_start}/{date_finished}', [ViewPrintController::class, 'trial_balance_pdf_view']);
    
   
});


