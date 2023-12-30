<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

	<!-- Sidebar content -->
	<div class="sidebar-content">

		<!-- User menu -->
		<div class="sidebar-section sidebar-user my-1">
			<div class="sidebar-section-body">
				<div class="media">
					<a href="/dashboard" class="mr-3">
						<img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" alt="">
					</a>

					<div class="media-body">
						<div class="font-weight-semibold">Xpert Digital Agency</div>
						<div class="font-size-sm line-height-sm opacity-50">
							Accounting Software
						</div>
					</div>

					<div class="ml-3 align-self-center">
						<button type="button" class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
							<i class="icon-transmission"></i>
						</button>

						<button type="button" class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-mobile-main-toggle d-lg-none">
							<i class="icon-cross2"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
		<!-- /user menu -->


		<!-- Main navigation -->
		<div class="sidebar-section">
			<ul class="nav nav-sidebar" data-nav-type="accordion">

				<!-- Main -->

				<li class="nav-item">
					<a href="/dashboard" class="nav-link  {{ (request()->is('dashboard'))  ? 'active' : '' }} "><i class="icon-home4"></i> <span>Dashboard</span></a>
				</li> 


				


				<li class="nav-item nav-item-submenu   {{ (request()->is('coffee/add-income')) ||  (request()->is('coffee/add-expenses')) || (request()->is('coffee/profit-loss')) ||  (request()->is('coffee/income-filter-post'))   ? 'nav-item-expanded nav-item-open' : '' }}">
					<a href="#" class="nav-link"><i class="icon-cup2"></i> <span>Managed coffee</span></a>

					<ul class="nav nav-group-sub" data-submenu-title="Layouts">
						<li class="nav-item"><a href="/coffee/add-income" class="nav-link {{ (request()->is('coffee/add-income'))  ? 'active' : '' }} ">Add Income</a></li>
						<li class="nav-item"><a href="/coffee/add-expenses" class="nav-link  {{ (request()->is('coffee/add-expenses'))  ? 'active' : '' }}  ">Add Expenses</a></li>
						<li class="nav-item"><a href="/coffee/profit-loss" class="nav-link  {{ (request()->is('coffee/profit-loss')) || (request()->is('coffee/income-filter-post')) ? 'active' : '' }}  ">Profit & Loss</a></li>


					</ul>
				</li>





				<li class="nav-item nav-item-submenu   {{ (request()->is('accounts/receive-voucher')) ||  (request()->is('accounts/payment-voucher')) || (request()->is('accounts/adjust-account')) || (request()->is('accounts/adjust-account-history')) || (request()->is('accounts/opening-balance')) || (request()->is('accounts/payment-voucher-view'))  || (request()->is('accounts/receive-voucher-view')) ||   (request()->is('accounts/other-account'))  ||   (request()->is('accounts/patron-opening-balance'))  ? 'nav-item-expanded nav-item-open' : '' }}">
					<a href="#" class="nav-link"><i class="icon-users2"></i> <span>Accounts</span></a>

					<ul class="nav nav-group-sub" data-submenu-title="Layouts">
						<li class="nav-item"><a href="/accounts/receive-voucher" class="nav-link {{ (request()->is('accounts/receive-voucher')) || (request()->is('accounts/receive-voucher-view')) ? 'active' : '' }} ">Receive Voucher</a></li>
						<li class="nav-item"><a href="/accounts/payment-voucher" class="nav-link  {{ (request()->is('accounts/payment-voucher')) || (request()->is('accounts/payment-voucher-view'))? 'active' : '' }}  ">Payment Voucher</a></li>
						
						<li class="nav-item nav-item-submenu  {{ (request()->is('accounts/adjust-account')) || (request()->is('account/other-account'))  || (request()->is('account/opening-account-view')) || (request()->is('accounts/adjust-account-history')) || (request()->is('accounts/opening-balance')) || (request()->is('accounts/other-account'))  ||   (request()->is('accounts/patron-opening-balance')) ? 'nav-item-expanded nav-item-open' : '' }}  ">
							<a href="#" class="nav-link">Account Adjustment</a>
							<ul class="nav nav-group-sub">

							    <li class="nav-item"><a href="/accounts/opening-balance" class="nav-link  {{ (request()->is('accounts/opening-balance')) ? 'active' : '' }}  ">Opening Balance</a></li>
								<li class="nav-item"><a href="/accounts/patron-opening-balance" class="nav-link  {{ (request()->is('accounts/patron-opening-balance')) ? 'active' : '' }}  ">Patron Opening Balance</a></li>
								<li class="nav-item"><a href="/accounts/other-account" class="nav-link  {{ (request()->is('accounts/other-account')) ? 'active' : '' }}  ">Other Account</a></li>
								<li class="nav-item"><a href="/accounts/adjust-account" class="nav-link  {{ (request()->is('accounts/adjust-account')) || (request()->is('accounts/adjust-account-history')) ? 'active' : '' }} ">Adjust Account Controller</a></li>
								

							</ul>
						</li>


					</ul>
				</li>



				<li class="nav-item nav-item-submenu   {{ (request()->is('payroll/job-record')) ||  (request()->is('payroll/payroll-preparation'))  ||  (request()->is('payroll/job-record-history')) ||  (request()->is('payroll/wage-distribution')) || (request()->is('payroll/payroll-preparation-history')) ? 'nav-item-expanded nav-item-open' : '' }}">
					<a href="#" class="nav-link"><i class="icon-coins"></i> <span>Payroll</span></a>

					<ul class="nav nav-group-sub" data-submenu-title="Layouts">
						<li class="nav-item"><a href="/payroll/job-record" class="nav-link {{ (request()->is('payroll/job-record')) ||  (request()->is('payroll/job-record-history'))  ? 'active' : '' }} ">Job Record</a></li>
						<li class="nav-item"><a href="/payroll/payroll-preparation" class="nav-link  {{ (request()->is('payroll/payroll-preparation')) || (request()->is('payroll/payroll-preparation-history')) ? 'active' : '' }}  ">Payroll Preparation</a></li>
						<li class="nav-item"><a href="/payroll/wage-distribution" class="nav-link  {{ (request()->is('payroll/wage-distribution')) ? 'active' : '' }}  ">Wages/Payroll Distribution & IOU</a></li>
					</ul>
				</li>





				<li class="nav-item nav-item-submenu   {{ (request()->is('chart-account/account-summery')) || (request()->is('chart-account/parent-account')) || (request()->is('chart-account/main-account')) || (request()->is('chart-account/child-account')) ||  (request()->is('chart-account/transaction-mode')) || (request()->is('chart-account/transaction-mode-view'))  ||  (request()->is('chart-account/transaction-mode-edit'))   ||  (request()->is('chart-account/transaction-mode-edit/*')) || (request()->is('chart-account/account-management'))? 'nav-item-expanded nav-item-open' : '' }}">
					<a href="#" class="nav-link"><i class="icon-list-unordered"></i> <span>Chart Of Account</span></a>

					<ul class="nav nav-group-sub" data-submenu-title="Layouts">
						<li class="nav-item"><a href="/chart-account/account-summery" class="nav-link {{ (request()->is('chart-account/account-summery')) ? 'active' : '' }} ">Account Summery</a></li>
						<li class="nav-item"><a href="/chart-account/parent-account" class="nav-link  {{ (request()->is('chart-account/parent-account')) ? 'active' : '' }}  ">Parent Account</a></li>
						<li class="nav-item"><a href="/chart-account/main-account" class="nav-link  {{ (request()->is('chart-account/main-account')) ? 'active' : '' }}   ">Main Account</a></li>
						<li class="nav-item"><a href="/chart-account/child-account" class="nav-link  {{ (request()->is('chart-account/child-account')) ? 'active' : '' }} ">Child Account</a></li>
						<li class="nav-item"><a href="/chart-account/transaction-mode" class="nav-link {{ (request()->is('chart-account/transaction-mode')) || (request()->is('chart-account/transaction-mode-view')) || (request()->is('chart-account/transaction-mode-edit'))   ||  (request()->is('chart-account/transaction-mode-edit/*'))  ? 'active' : '' }} ">Transaction Mode</a></li>
						<!--Trading Account or Profit & Loss Manage -->
						<li class="nav-item"><a href="/chart-account/account-management" class="nav-link {{ (request()->is('chart-account/account-management')) ? 'active' : '' }} ">Account Management</a></li>

					</ul>
				</li>

				<li class="nav-item nav-item-submenu   {{ (request()->is('initial/project'))  || (request()->is('initial/patron-category')) ||  (request()->is('initial/patron-status-view')) ||  (request()->is('initial/patron-details')) || (request()->is('initial/project-type')) ||  (request()->is('initial/patron-details-view'))  ||  (request()->is('initial/project-type-view')) ||  (request()->is('initial/project-details-view')) ||  (request()->is('initial/bank'))  ||  (request()->is('initial/bank-details-view')) ||  (request()->is('initial/department-position')) ||  (request()->is('initial/department-position/add')) ||  (request()->is('initial/department-position-view')) || (request()->is('initial/human-resource'))  || (request()->is('initial/human-resource-view')) || (request()->is('initial/payroll-breakup-add')) || (request()->is('initial/payroll-breakup-basic')) || (request()->is('initial/payroll-breakup-view'))  || (request()->is('initial/payroll-breakup-deduction')) || (request()->is('initial/human-resource-view/edit/*'))  ? 'nav-item-expanded nav-item-open' : '' }} ">
					<a href="#" class="nav-link"><i class="icon-star-empty3"></i> <span>Initial</span></a>

					<ul class="nav nav-group-sub" data-submenu-title="Layouts">
						<li class="nav-item"><a href="/initial/project" class="nav-link  {{ (request()->is('initial/project')) || (request()->is('initial/project-details-view')) ? 'active' : '' }} ">Project/Job-ID</a></li>
						<li class="nav-item"><a href="/initial/project-type" class="nav-link  {{ (request()->is('initial/project-type')) || (request()->is('initial/project-type-view'))  ? 'active' : '' }} ">Project Type</a></li>
						<li class="nav-item nav-item-submenu   {{ (request()->is('initial/patron-category')) ||  (request()->is('initial/patron-details'))  ||   (request()->is('initial/patron-status-view')) ||  (request()->is('initial/patron-details-view'))  ? 'nav-item-expanded nav-item-open' : '' }}">
							<a href="/initial/patron-details" class="nav-link  {{ (request()->is('initial/patron-details')) ? 'active' : '' }} ">Patron</a>
							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item">
									<a href="/initial/patron-details" class="nav-link  {{ (request()->is('initial/patron-details')) || (request()->is('initial/patron-details-view')) ? 'active' : '' }} ">Add Patron</a>

								</li>
								<li class="nav-item">
									<a href="/initial/patron-category" class="nav-link  {{ (request()->is('initial/patron-category')) || (request()->is('initial/patron-status-view')) ? 'active' : '' }} ">Patron Category</a>

								</li>

							</ul>
						</li>

						<li class="nav-item"><a href="/initial/bank" class="nav-link  {{ (request()->is('initial/bank')) || (request()->is('initial/bank-details-view')) ? 'active' : '' }} ">Bank</a></li>

						<li class="nav-item nav-item-submenu   {{ (request()->is('initial/department-position')) || (request()->is('initial/department-position/add')) || (request()->is('initial/department-position-view')) || (request()->is('initial/human-resource'))  || (request()->is('initial/human-resource-view')) || (request()->is('initial/payroll-breakup-add')) || (request()->is('initial/payroll-breakup-basic')) || (request()->is('initial/payroll-breakup-view'))  || (request()->is('initial/payroll-breakup-deduction')) || (request()->is('initial/human-resource-view/edit/*')) ? 'nav-item-expanded nav-item-open' : '' }}">
							<a href="/initial/patron-details" class="nav-link  {{ (request()->is('initial/hr')) ? 'active' : '' }} ">HR</a>
							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item">
									<a href="/initial/department-position" class="nav-link  {{ (request()->is('initial/department-position')) || (request()->is('initial/department-position/add')) || (request()->is('initial/department-position-view')) ? 'active' : '' }} ">Department & Position</a>


								</li>
								<li class="nav-item">
									<a href="/initial/human-resource" class="nav-link  {{ (request()->is('initial/human-resource')) || (request()->is('initial/patron-status-view'))  || (request()->is('initial/human-resource-view')) ? 'active' : '' }} ">Human Resource</a>

								</li>

								<li class="nav-item nav-item-submenu   {{ (request()->is('initial/payroll-breakup-add')) || (request()->is('initial/payroll-breakup-basic'))  || (request()->is('initial/payroll-breakup-view')) || (request()->is('initial/payroll-breakup-deduction')) ? 'nav-item-expanded nav-item-open' : '' }}">
									<a href="/initial/payroll-breakup" class="nav-link  ">Payroll Breakup</a>
									<ul class="nav nav-group-sub" data-submenu-title="Layouts">

										<li class="nav-item">
											<a href="/initial/payroll-breakup-basic" class="nav-link  {{ (request()->is('initial/payroll-breakup-basic')) || (request()->is('initial/payroll-breakup-view')) ? 'active' : '' }}">Basic</a>

										</li>


										<li class="nav-item">
											<a href="/initial/payroll-breakup-add" class="nav-link  {{ (request()->is('initial/payroll-breakup-add')) ? 'active' : '' }}">Addings | Incentive | Transport | Mobile</a>

										</li>

										<li class="nav-item">
											<a href="/initial/payroll-breakup-deduction" class="nav-link  {{ (request()->is('initial/payroll-breakup-deduction')) ? 'active' : '' }} ">Deduction | Loan limit | Loan Adjust | Comphensation</a>

										</li>

									</ul>

								</li>

							</ul>
						</li>






					</ul>
				</li>


				<li class="nav-item nav-item-submenu   {{ (request()->is('view-print/payroll-sheet')) ||  (request()->is('view-print/payroll-sheet-post')) ||  (request()->is('view-print/payroll-sheet-till-date')) ||  (request()->is('view-print/hr-account')) ||  (request()->is('view-print/journal'))  || (request()->is('view-print/journal-view'))  || (request()->is('view-print/journal-post')) || (request()->is('view-print/journal-specific')) || (request()->is('view-print/journal-specific-post')) || (request()->is('view-print/ledger')) || (request()->is('view-print/ledger-controller'))  || (request()->is('view-print/ledger-post')) || (request()->is('view-print/ledger-patron')) || (request()->is('view-print/ledger-patron-post')) || (request()->is('view-print/ledger-bank'))   || (request()->is('view-print/ledger-bank-post'))  || (request()->is('view-print/ledger-income'))  || (request()->is('view-print/ledger-income-post')) || (request()->is('view-print/ledger-cash'))  || (request()->is('view-print/ledger-cash-post')) || (request()->is('view-print/balance')) || (request()->is('view-print/trial-balance-post')) || (request()->is('view-print/trading-account')) || (request()->is('view-print/trading-post'))  || (request()->is('view-print/profit-loss')) || (request()->is('view-print/profit-loss-post')) || (request()->is('view-print/balance-sheet'))  || (request()->is('view-print/balance-sheet-post')) ? 'nav-item-expanded nav-item-open' : '' }}">
					<a href="#" class="nav-link"><i class="icon-printer4"></i> <span>View Print</span></a>

					<ul class="nav nav-group-sub" data-submenu-title="Layouts">

						<li class="nav-item nav-item-submenu   {{ (request()->is('view-print/payroll-sheet')) ||  (request()->is('view-print/payroll-sheet-post'))  ||  (request()->is('view-print/payroll-sheet-till-date')) ||  (request()->is('view-print/hr-account'))  ? 'nav-item-expanded nav-item-open' : '' }} ">
							<a href="#" class="nav-link  ">Payroll</a>
							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								
								<li class="nav-item">
									<a href="/view-print/payroll-sheet" class="nav-link  {{ (request()->is('view-print/payroll-sheet'))  ||  (request()->is('view-print/payroll-sheet-post')) ||  (request()->is('view-print/payroll-sheet-till-date')) ? 'active' : '' }} ">Payroll Sheet</a>

								</li>

								<li class="nav-item">
									<a href="/view-print/hr-account" class="nav-link  {{   (request()->is('view-print/hr-account')) ? 'active' : '' }} ">HR Account</a>

								</li>

							</ul>
						</li>

						<li class="nav-item nav-item-submenu   {{ (request()->is('view-print/journal')) || (request()->is('view-print/ledger')) ||  (request()->is('view-print/balance')) ||  (request()->is('view-print/final-accounts')) ||  (request()->is('view-print/project-job')) || (request()->is('view-print/journal-view')) || (request()->is('view-print/journal-post')) || (request()->is('view-print/journal-specific')) || (request()->is('view-print/journal-specific-post')) || (request()->is('view-print/ledger-controller')) || (request()->is('view-print/ledger-post')) || (request()->is('view-print/ledger-patron'))  || (request()->is('view-print/ledger-patron-post'))  || (request()->is('view-print/ledger-bank')) || (request()->is('view-print/ledger-bank-post')) || (request()->is('view-print/ledger-income')) || (request()->is('view-print/ledger-income-post')) || (request()->is('view-print/ledger-cash')) || (request()->is('view-print/ledger-cash-post')) || (request()->is('view-print/trial-balance-post')) || (request()->is('view-print/trading-account')) || (request()->is('view-print/trading-post')) || (request()->is('view-print/profit-loss')) || (request()->is('view-print/profit-loss-post')) || (request()->is('view-print/balance-sheet')) || (request()->is('view-print/balance-sheet-post'))? 'nav-item-expanded nav-item-open' : '' }} ">
							<a href="#" class="nav-link  ">Accounts</a>
							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								
								<li class="nav-item">
									<a href="/view-print/journal" class="nav-link  {{ (request()->is('view-print/journal')) ||  (request()->is('view-print/journal-view')) || (request()->is('view-print/journal-post')) || (request()->is('view-print/journal-specific')) || (request()->is('view-print/journal-specific-post')) ? 'active' : '' }} ">Journal</a>

								</li>

								<li class="nav-item">
									<a href="/view-print/ledger" class="nav-link  {{   (request()->is('view-print/ledger')) || (request()->is('view-print/ledger-controller')) || (request()->is('view-print/ledger-post'))  || (request()->is('view-print/ledger-patron')) || (request()->is('view-print/ledger-patron-post'))  || (request()->is('view-print/ledger-bank')) || (request()->is('view-print/ledger-bank-post'))  || (request()->is('view-print/ledger-income')) || (request()->is('view-print/ledger-income-post')) || (request()->is('view-print/ledger-cash'))  || (request()->is('view-print/ledger-cash-post')) ? 'active' : '' }} ">Ledger</a>

								</li>

								<li class="nav-item">
									<a href="/view-print/balance" class="nav-link  {{   (request()->is('view-print/balance')) || (request()->is('view-print/trial-balance-post')) ? 'active' : '' }} ">Trial Balance</a>

								</li>

								<li class="nav-item">
									<a href="/view-print/trading-account" class="nav-link  {{   (request()->is('view-print/trading-account')) || (request()->is('view-print/trading-post')) ? 'active' : '' }} ">Trading Account</a>

								</li>  

								<li class="nav-item">
									<a href="/view-print/profit-loss" class="nav-link  {{   (request()->is('view-print/profit-loss')) || (request()->is('view-print/profit-loss-post')) ? 'active' : '' }} ">Profit & Loss</a>

								</li> 

								<li class="nav-item">
									<a href="/view-print/balance-sheet" class="nav-link  {{   (request()->is('view-print/balance-sheet'))  || (request()->is('view-print/balance-sheet-post')) ? 'active' : '' }} ">Balance Sheet</a>

								</li>





							</ul>
						</li>



					</ul>

				</li>


				


			</ul>
		</div>
		<!-- /main navigation -->

	</div>
	<!-- /sidebar content -->

</div>