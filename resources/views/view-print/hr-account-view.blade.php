<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Xpert SEO | Chart Of Accounts</title>
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
                                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>Initial</a>
                                <span class="breadcrumb-item active">Human Resource Views</span>
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
                        <div class="col-md-12">

                            <!-- Traffic sources -->
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title text-center"><b>Xpert SEO Service</b></h2>
                                    <p class="text-center">16/d/3, DIN NATH SN ROAD, GANDRIA, DHAKA-1204 (+880 194 555 0555)</p>
                                    
                                    <p class="text-center" style="font-weight:bold">PAYROLL SHEET</p>
                                    <p class="text-center">From - {{date('d-M-Y', strtotime($date_start))}}</p>
                                    <p class="text-center">To - {{date('d-M-Y', strtotime($date_finished))}} </p>
                                    <hr style="border: 2px solid black;">

                                </div>

                                <div class="card-body">
                                    <table class="table  table-striped table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <td>Date</td>

                                                <td colspan="3" style="text-align: center;">Payable / Receivable</td>
                                                <td colspan="3" style="text-align: center;">Adjustment</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                <td></td>

                                                <td>Payroll</td>
                                                <td>Advance</td>
                                                <td>Loan</td>
                                                <td>Payroll</td>
                                                <td>Advance</td>
                                                <td>Loan</td>

                                            </tr>

                                            @foreach($hr_record as $item)
                                                <tr>
                                                    <td>{{date('d-M-Y', strtotime($item->date))}}</td>
                                                    <td>{{$item->p_payroll}}</td>
                                                    <td>{{$item->p_advance}}</td>
                                                    <td>{{$item->p_loan}}</td>
                                                    <td>{{$item->a_payroll}}</td>
                                                    <td>{{$item->a_advance}}</td>
                                                    <td>{{$item->a_loan}}</td>
                                                
                                                </tr>
                                            @endforeach

                                           

                                        </tbody>

                                        <thead>

                                        </thead>

                                    </table>

                                </div>

                            </div>
                            <!-- /traffic sources -->

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

</body>

</html>