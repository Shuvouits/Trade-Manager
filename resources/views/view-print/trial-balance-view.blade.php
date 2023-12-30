<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Xpert SEO | Trial Balance</title>
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
                                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>Project</a>
                                <span class="breadcrumb-item active">List Of Project Type</span>
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
                        <div class="col-md-10 offset-md-1">

                            <!-- Traffic sources -->
                            <div class="card">

                                <div class="card-header" style="font-size: 12px;">
                                    <h2 class="card-title text-center"><b>Xpert Digital Agency</b></h2>
                                    <p class="text-center">16/d/3, DIN NATH SN ROAD, GANDRIA, DHAKA-1204</p>
                                    <p class="text-center">+880 194 555 0555</p>
                                    <p class="text-center" style="font-weight:bold">Trial Balance</p>
                                    <p class="">From Date : <span style="font-size: 12px;">{{date('d-M-Y', strtotime($date_start))}}</span> </p>
                                    <p class="">To Date : <span style="font-size: 12px;">{{date('d-M-Y', strtotime($date_finished))}}</span> </p>
                                    <a href="/view-print/trial-balance-pdf/{{$date_start}}/{{$date_finished}}" class="btn btn-primary">Download PDF</a>
                                   
                                    <hr>




                                </div>


                                <div class="card-body" style="font-size: 12px;">
                                    <table class="table datatable-basic table-striped table-hover">
                                        <thead>
                                            <th>Serial Number</th>
                                            <th>Name Of Accounts</th>
                                            <th>DR</th>
                                            <th>CR</th>


                                        </thead>
                                        <tbody>
                                            @foreach($trial_balance_debit as $count=>$item)

                                            <tr style="text-transform: uppercase;">
                                                <td>{{$count+1}}</td>
                                                <td>
                                                    <p>{{$item->accounts_name}}</p>

                                                </td>
                                                <td style="font-weight : bold">

                                                   
                                                    {{ number_format($item->final_dr, 2) }}


                                                </td>

                                                <td >
                                         
                                                    {{($item->final_cr) }}

                                                </td>

                                            </tr>

                                            @endforeach

                                            @foreach($trial_balance_credit as $count=>$data)

                                            <tr style="text-transform: uppercase;">
                                                <td>{{$trial_balance_debit_count+$count+1}}</td>
                                                <td>
                                                    <p>{{$data->accounts_name}}</p>

                                                </td>
                                                <td>

                                                    {{$data->final_dr}}
                                                </td>
                                                <td style="font-weight : bold">
                                                 
                                                    {{ number_format($data->final_cr, 2) }}

                                                </td>


                                            </tr>

                                            @endforeach


                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td style="color:green; font-weight:bold">{{$total_dr}}</td>
                                                <td style="color:green; font-weight:bold">{{$total_cr}}</td>


                                            </tr>




                                        </tbody>

                                    </table>




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