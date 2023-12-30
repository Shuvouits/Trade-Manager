<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Xpert SEO | Balance Sheet</title>
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
                                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>ViewPrint</a>
                                <span class="breadcrumb-item active">Accounts</span>
                                <span class="breadcrumb-item active">Profit & Loss Account</span>
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

                            <!-- journal card -->
                            <div class="card">

                                <div class="card-header" style="font-size: 12px;">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <p class="">From Date :{{ date('d-M-Y', strtotime($date_start)) }}
                                            </p>
                                            <p class="">To Date : {{ date('d-M-Y', strtotime($date_finished)) }}
                                            </p>

                                        </div>

                                        <div class="col-md-5">
                                            <h2 class="card-title"><b>Xpert SEO Service</b></h2>
                                            <p>16/d/3, DIN NATH SN ROAD, GANDRIA, DHAKA-1204</p>
                                            <p>+880 194 555 0555</p>
                                            <p style="font-weight:bold">Balance Sheet</p>

                                        </div>


                                    </div>


                                </div>



                                <div class="card-body">

                                    

                                    <div class="row">
                                        <div class="col-md-12">

                                            <table class="table table-striped table-bordered table-hover" style="font-size:12px">
                                                <thead>
                                                    <th>Assets</th>
                                                    <th></th>
                                                    <th>Equity & Liablity</th>
                                                    <th></th>
                                                    
                                                </thead>
                                                <tbody>
                                                    @foreach($balance_sheet as $item)

                                                     
                                                      <tr>
                                                        <td>
                                                            @if($item->section == 3)
                                                              {{$item->account_name}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($item->section == 3)
                                                              {{$item->amount}}
                                                            @endif

                                                        </td>
                                                        <td>
                                                            @if($item->section == 4)
                                                              {{$item->account_name}}
                                                            @endif

                                                        </td>

                                                        <td>
                                                            @if($item->section == 4)
                                                              {{$item->amount}}
                                                            @endif

                                                        </td>
                                                      </tr>
                                                     
                                                   
                                                    @endforeach

                                                    <tr>
                                                        <td></td>
                                                        <td style="font-weight: bold;">{{$sum_asset}}</td>
                                                        <td></td>
                                                        <td style="font-weight: bold;"> {{$sum_equity}}</td>
                                                    </tr>


                                                </tbody>

                                            </table>

                                        </div>


                                    </div>



                                </div>

                            </div>
                            <!-- /end journal card -->

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