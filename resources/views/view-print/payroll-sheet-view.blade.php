<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Xpert SEO | Chart Of Accounts</title>
    @include('link')
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>


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
                <div class="content" >

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
                                    <p class="text-center">To - {{date('d-M-Y', strtotime($date_finished))}}</p>

                                    <hr>




                                </div>

                                <div class="card-body">
                                    <table class="table table-responsive" style="font-size:10px" id="employee_data">
                                        <a href="/view-print/export-data/{{date('d-M-Y', strtotime($date_start))}}/{{date('d-M-Y', strtotime($date_finished))}}" class="btn btn-success">Export PDF</a>
                                        <!----<button id="export_button" class="btn btn-success">Export Excel</button> --->


                                        <thead>
                                            <th>Name</th>
                                            <th>Basic</th>
                                            <th>House-Rent</th>
                                            <th>Medical-Allowance</th>
                                            <th>Transport-Allowance</th>
                                            <th>Over-Time</th>
                                            <th>Festival-Bonus</th>
                                            <th>Incentive-Bonus</th>
                                            <th>Mobile</th>
                                            <th>Other-Benifit</th>
                                            <th>Gross-Salary</th>
                                            <th>Advance Loan</th>
                                            <th>Comphensation</th>
                                            <th>Loan-Adjusted</th>
                                            <th>Provident-Fund</th>

                                            <th>Income-Tax</th>
                                            <th>Other-Deduction</th>
                                            <th>Advance Salary</th>

                                            <th>Dues Payroll</th>
                                        </thead>
                                        <tbody>
                                            @foreach($job_record as $item)
                                            <tr>
                                                <td>



                                                    <p>
                                                        @foreach($hr as $data)
                                                        @if($data->id == $item->hr)

                                                        {{$data->name}}
                                                        @endif
                                                        @endforeach

                                                    </p>





                                                </td>
                                                <td>{{$item->basic}}</td>

                                                <td>{{$item->house_rent}}</td>
                                                <td>{{$item->medical_allowance}}</td>
                                                <td>{{$item->transport_allowance}}</td>
                                                <td>{{$item->over_time}}</td>
                                                <td>

                                                    {{$item->festival_bonus}}
                                                </td>
                                                <td>{{$item->incentive}}</td>
                                                <td>{{$item->mobile}}</td>
                                                <td>{{$item->other_benifit}}</td>
                                                <td>{{$item->gross_salary}}</td>
                                                <td>{{$item->advance}}</td>
                                                <td>{{$item->comphensation}}</td>
                                                <td>{{$item->loan_adjust}}</td>
                                                <td>{{$item->provident_fund}}</td>
                                                <td>{{$item->income_tax}}</td>

                                                <td>{{$item->other_deduction}}</td>
                                                <td>{{$item->advance_salary}}</td>

                                                <td>

                                                    {{$item->due_net_payroll}}

                                                </td>

                                            </tr>

                                            @endforeach
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Total = </td>



                                                <td>{{$job_record_total}}</td>
                                            </tr>
                                        </tbody>

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