<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    @include('link')
    <title>
        XPERT DIGITAL AGENCY
        16/D/3, DIN NATH SEN ROAD, GANDRIA, DHAKA-1204
        {{session()->get('purpose')}} ({{date('d-M-Y', strtotime($date_start))}} to {{date('d-M-Y', strtotime($date_finished))}})

    </title>


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
                                <span class="breadcrumb-item active">Ledger</span>
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
                        <div class="col-md-12 " style="margin-top:30px">

                            <!-- Traffic sources -->
                            <div class="card">

                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <h2 class="card-title text-center"><b>XPERT DIGITAL AGENCY</b></h2>
                                            <p class="text-center">16/D/3, DIN NATH SEN ROAD, GANDRIA, DHAKA-1204</p>
                                            <p class="text-center">+880 194 555 0555</p>
                                            <p class="text-center" style="font-weight:bold">{{session()->get('purpose')}} ({{date('d-M-Y', strtotime($date_start))}} to {{date('d-M-Y', strtotime($date_finished))}})</p>

                                        </div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <table class="table-bordered  table-striped table-hover table" style="font-size: 11px;">
                                                <thead>
                                                    <tr>
                                                        <th>Balance</th>
                                                        <th>Summery</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Opening</td>
                                                        <td>{{number_format($opening_balance_data,2)}}</td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>DR</td>
                                                        <td>{{number_format($sum_voucher_debit,2)}}</td>

                                                    </tr>

                                                    <tr>
                                                        <td>CR</td>
                                                        <td>{{number_format($sum_voucher_credit,2)}}</td>

                                                    </tr>

                                                    <tr>
                                                        <td>Balance Dr</td>
                                                       
                                                        <td>{{number_format($balance_dr,2)}}</td>
                                                        

                                                    </tr>

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>




                                </div>


                                <div class="card-body">


                                    <table class="table  table-hover datatable-button-html5-basic table-striped" style="font-size:12px">


                                        <!-----
                                        <br>
                                        <div class="text-center">
                                            <a href="/view-print/export-cash/{{date('d-M-Y', strtotime($date_start))}}/{{date('d-M-Y', strtotime($date_finished))}}" class="btn btn-success">Export To PDF</a>
                                        </div>
                                        ---->


                                        <thead>


                                            
                                                <th>Date</th>
                                                <th>REF</th>

                                                <th>Particulars</th>
                                                <th>Related A/C</th>
                                                <th>DR.</th>
                                                <th>CR.</th>
                                            


                                        </thead>



                                        <tbody>

                                            <tr class="sr-only">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Summery | Balances</td>
                                                <td></td>
                                                <td></td>

                                            </tr>


                                            <tr class="sr-only">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Opening = {{number_format($opening_balance_data,2)}}</td>
                                                <td></td>
                                                <td></td>

                                            </tr>

                                            <tr class="sr-only">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>DR = {{number_format($sum_voucher_debit,2)}}</td>
                                                <td></td>
                                                <td></td>

                                            </tr>

                                            <tr class="sr-only">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>CR = {{number_format($sum_voucher_credit,2)}}</td>
                                                <td></td>
                                                <td></td>

                                            </tr>


                                            <tr class="sr-only">
                                                <td></td>
                                                <td></td>
                                                <td></td>

                                                <td>Balance Dr = {{number_format($balance_dr,2)}}</td>
                                                <td></td>
                                                <td></td>

                                            </tr>

                                            @if($debit_balance == 0 && $credit_balance ==0 && $date == '')
                                            @else
                                            <tr>
                                                <td>{{date('d-M-Y', strtotime($date))}}</td>
                                                <td>-</td>
                                                <td>Opening Balance</td>
                                                <td>-</td>
                                                <td style="font-weight: bold;">
                                                    @if($opening_balance_data > 0)
                                                      {{number_format($opening_balance_data,2)}}
                                                    
                                                    @else 
                                                    0
                                                    @endif
                                                    
                                                </td>
                                                <td style="font-weight:bold">
                                                    @if($opening_balance_data < 0)
                                                       <span class="sr-only">{{$opening_balance_data = (0-$opening_balance_data)}}</span>
                                                       {{number_format($opening_balance_data,2)}}
                                                    
                                                    @else 
                                                    0
                                                    @endif
                                                    
                                                </td>
                                            </tr>
                                            @endif

                                            @foreach($voucher_credit as $item)

                                            <tr>
                                                <td>
                                                    @foreach($voucher as $data)
                                                    @if($data->id == $item->voucher_id)
                                                    <p>{{date('d-M-Y', strtotime($data->date))}}</p>
                                                    @endif
                                                    @endforeach
                                                </td>

                                                <td>
                                                    @foreach($voucher as $data)
                                                    @if($data->id == $item->voucher_id)
                                                    <p>{{$data->referrence}}</p>
                                                    @endif
                                                    @endforeach
                                                </td>

                                                <td>

                                                    @foreach($voucher as $data)

                                                    @if($data->id == $item->voucher_id)

                                                    @if($item->account_id == $data->account_id)
                                                    <p>{{$data->additional_account_name}}</p>

                                                    @if($data->additional_account_name == "")
                                                    <p>{{$data->transaction_mode_name}}</p>
                                                    @endif

                                                    @elseif($account_id == $data->additional_account)
                                                    <p>{{$data->account_name}}</p>

                                                    @endif


                                                    @endif

                                                    @endforeach


                                                </td>

                                                <td>
                                                    @foreach($voucher as $data)
                                                    @if($data->id == $item->voucher_id)
                                                    <p>{{$data->sub_account_name}}</p>
                                                    @endif
                                                    @endforeach





                                                </td>


                                                <td>
                                                    -
                                                </td>



                                                <td style="font-weight:bold">
                                                    @foreach($voucher as $data)
                                                    @if($data->id == $item->voucher_id)
                                                    <p>{{number_format($item->amount,2)}}</p>
                                                    @endif
                                                    @endforeach
                                                </td>




                                            </tr>

                                            @endforeach


                                            @foreach($voucher_debit as $item)

                                            <tr>
                                                <td>
                                                    @foreach($voucher as $data)
                                                    @if($data->id == $item->voucher_id)
                                                    <p>{{date('d-M-Y', strtotime($data->date))}}</p>
                                                    @endif
                                                    @endforeach
                                                </td>

                                                <td>
                                                    @foreach($voucher as $data)
                                                    @if($data->id == $item->voucher_id)
                                                    <p>{{$data->referrence}}</p>
                                                    @endif
                                                    @endforeach
                                                </td>

                                                <td>

                                                    @foreach($voucher as $data)

                                                    @if($data->id == $item->voucher_id)

                                                    @if($item->account_id == $data->account_id)
                                                    <p>{{$data->additional_account_name}}</p>

                                                    @if($data->additional_account_name == "")
                                                    <p>{{$data->transaction_mode_name}}</p>
                                                    @endif


                                                    @elseif($account_id == $data->additional_account)
                                                    <p>{{$data->account_name}}</p>

                                                    @endif


                                                    @endif

                                                    @endforeach

                                                </td>

                                                <td>
                                                    @foreach($voucher as $data)
                                                    @if($data->id == $item->voucher_id)
                                                    <p>{{$data->sub_account_name}}</p>
                                                    @endif
                                                    @endforeach


                                                    @foreach($voucher as $data)
                                                    @if($data->id == $item->voucher_id)
                                                    <p>{{$data->bank_name}}</p>

                                                    @endif
                                                    @endforeach



                                                </td>



                                                <td style="font-weight:bold">
                                                    @foreach($voucher as $data)
                                                    @if($data->id == $item->voucher_id)
                                                    <p>{{number_format($item->amount,2)}}</p>
                                                    @endif
                                                    @endforeach
                                                </td>

                                                <td>
                                                    -
                                                </td>


                                            </tr>

                                            @endforeach




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