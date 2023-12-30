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
                                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>Chart Of Accounts</a>
                                <span class="breadcrumb-item active">Transaction Mode</span>
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

                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title text-center"><b>Xpert SEO Service</b></h2>
                                    <p class="text-center">16/d/3, DIN NATH SN ROAD, GANDRIA, DHAKA-1204</p>
                                    <p class="text-center">+880 194 555 0555</p>
                                    <p class="text-center" style="font-weight:bold">Transaction Area</p>
                                   
                                </div>

                                <div class="card-body">

                                    <table class="table datatable-basic">
                                        <thead class="text-center">
                                            <th>#</th>
                                            <th>Name of Account</th>
                                            <th>Transaction Mode</th>
                                            <th>Patron Zone</th>
                                            <th>Voucher Type</th>
                                            <th>Action</th>


                                        </thead>
                                        <tbody class="text-center">
                                            @foreach($transaction_area as $count=>$item)
                                            <tr>
                                                <td>{{$item->id}}</td>
                                                <td>
                                                    @foreach($child_account as $data)
                                                    @if($data->id == $item->child_account)
                                                    {{$data->name}}
                                                    @endif

                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach($transaction_mode as $data)
                                                    @if($data->id == $item->transaction_mode)
                                                    {{$data->name}}
                                                    @endif
                                                    @endforeach

                                                </td>
                                                <td>
                                                    @foreach($patron_zone as $data)
                                                    @if($data->id == $item->patron_status)
                                                    <p>{{$data->status}}</p>
                                                    @endif
                                                    @endforeach

                                                </td>
                                                <td>
                                                    @if($item->voucher_type == 0)
                                                    <p>Receive</p>
                                                    @else
                                                    <p>Payment</p>
                                                    @endif

                                                </td>

                                                <td class="text-center">
                                                    <div class="list-icons">
                                                        <div class="dropdown">
                                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                
                                                                <a href="/chart-account/transaction-mode-delete/{{$item->id}}" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                            @endforeach

                                        </tbody>

                                    </table>

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

</body>

</html>