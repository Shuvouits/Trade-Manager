<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Xpert SEO | Dashboard</title>
    @include('link')


</head>

<body>

    <!-- Main navbar -->
    @include('navbar')
    <!-- /main navbar -->


    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        @include('sidebar')
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Inner content -->
            <div class="content-inner">

                <!-- Page header -->
                <div class="page-header page-header-light">


                    <div class="breadcrumb-line breadcrumb-line-dark header-elements-lg-inline">
                        <div class="d-flex">
                            <div class="breadcrumb">
                                <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard </a>

                            </div>

                            <a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
                        </div>


                    </div>
                </div>
                <!-- /page header -->


                <!-- Content area -->
                <div class="content">

                    <!-- Main charts -->
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header header-elements-inline bg-secondary text-white ">
                                    <h6 class="card-title" style="text-align: center;">Account</h6>
                                </div>

                                <div class="card-body">
                                   <a href="/accounts/receive-voucher" class="btn btn-secondary ">Receive Voucher</a>
                                   <a href="/accounts/payment-voucher" class="btn btn-secondary ">Payment Voucher</a>
                                   <a href="/accounts/opening-balance" class="btn btn-secondary ">Opening Balance</a>
                                   <a href="accounts/adjust-account" class="btn btn-secondary ">Account Adjustment</a>
                                   <hr>
                                  
                                   
                                  
                                </div>
                            </div>
                        </div> 

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header header-elements-inline bg-secondary text-white ">
                                    <h6 class="card-title" style="text-align: center;">Payroll</h6>
                                </div>

                                <div class="card-body">
                                   <a href="/payroll/job-record" class="btn btn-secondary">Job Record</a>
                                   <a href="/payroll/payroll-preparation" class="btn btn-secondary">Payroll Preparation</a>
                                 
                                   <a href="/payroll/wage-distribution" class="btn btn-secondary">Wayges/Payroll Distribution & IOU</a>
                                   <hr>
                                   
                                  
                                  
                                </div>
                            </div>
                        </div>  


                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header header-elements-inline bg-secondary text-white ">
                                    <h6 class="card-title" style="text-align: center;">Chart Of Accounts</h6>
                                </div>

                                <div class="card-body">
                                   <a href="/chart-account/account-summery" class="btn btn-secondary">Account Summery</a>
                                   <a href="/chart-account/parent-account" class="btn btn-secondary">Parent Account</a>
                                   <a href="/chart-account/main-account" class="btn btn-secondary">Main Account</a>
                                  
                                   <a href="/chart-account/child-account" class="btn btn-secondary">Child Account</a>
                                   
                                   <a href="/chart-account/transaction-mode" class="btn btn-secondary">Transaction Mode</a>
                                   <hr>
                                   
                                  
                                  
                                </div>
                            </div>
                        </div>  


                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header header-elements-inline bg-secondary text-white ">
                                    <h6 class="card-title" style="text-align: center;">Patron</h6>
                                </div>

                                <div class="card-body">
                                   <a href="/initial/patron-details" class="btn btn-secondary">Add Patron</a>
                                   <a href="/initial/patron-category" class="btn btn-secondary">Patron Category</a>
                                   <a href="/initial/patron-details-view" class="btn btn-secondary">Patron Details</a>
                                  
                                   
                                   <hr>
                                  
                                </div>
                            </div>
                        </div>  

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header header-elements-inline bg-secondary text-white ">
                                    <h6 class="card-title" style="text-align: center;">HR</h6>
                                </div>

                                <div class="card-body">
                                   <a href="/initial/department-position" class="btn btn-secondary">Department & Position</a>
                                   <a href="/initial/human-resource" type="button" class="btn btn-secondary">Add HR</a>
                                   <a href="/initial/human-resource-view" class="btn btn-secondary">HR Details</a>
                                  
                                   
                                   <hr>
                                  
                                </div>
                            </div>
                        </div>  


                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header header-elements-inline bg-secondary text-white ">
                                    <h6 class="card-title" style="text-align: center;">Payroll BreakUp</h6>
                                </div>

                                <div class="card-body">
                                   <a href="/initial/payroll-breakup-basic" class="btn btn-secondary">Basic</a>
                                   <a href="/initial/payroll-breakup-add" class="btn  btn-secondary">Adding | Incentive | Transport | Mobile</a> 
                                   <a href="/initial/payroll-breakup-deduction" class="btn  btn-secondary"> Deduction | Loan Limit | Loan Adjust | Comphensation</a> 
                                  
                                   
                                   <hr>
                                  
                                </div>
                            </div>
                        </div>  

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header header-elements-inline bg-secondary text-white ">
                                    <h6 class="card-title" style="text-align: center;">ViewPrint/Payroll</h6>
                                </div>

                                <div class="card-body">
                                   <a href="/view-print/payroll-sheet"  class="btn btn-secondary">Payroll Sheet</a>
                                   <a href="/view-print/hr-account" class="btn  btn-secondary">HR Account</a>
                                  
                                  
                                   
                                   <hr>
                                  
                                </div>
                            </div>
                        </div>  

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header header-elements-inline bg-secondary text-white ">
                                    <h6 class="card-title" style="text-align: center;">ViewPrint/Accounts</h6>
                                </div>

                                <div class="card-body">
                                   <a href="/view-print/journal" class="btn btn-secondary">Journal</a>
                                   <a href="/view-print/ledger" class="btn  btn-secondary">Ledger</a>
                                   <a href="/view-print/balance" class="btn btn-secondary">Trial Balance</a> 
                                   <a href="/view-print/trading-account" class="btn  btn-secondary">Trading Account</a> 
                                   <a href="/view-print/profit-loss" class="btn  btn-secondary">Profit & Loss</a> 
                                   <a href="/view-print/balance-sheet" class="btn  btn-secondary">Balance Sheet</a> 
                                  
                                  
                                   
                                   <hr>
                                  
                                </div>
                            </div>
                        </div>

                        

                       
                    </div>
                    <!-- /main charts -->




                </div>
                <!-- /content area -->




            </div>
            <!-- /inner content -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->





    <!-- The Modal -->




    @if(Session::has('success'))
    <script>
        Swal.fire({
            toast: true,
            icon: 'success',
            //title: 'Ooops invalid !! error your email or password',
            title: "{{ session()->get('success') }}",
            animation: false,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    </script>
    @endif






</body>

</html>