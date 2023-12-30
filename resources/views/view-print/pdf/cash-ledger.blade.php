<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Xpert SEO | Ledger</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    


</head>

<body>

   


    <!-- Page content -->
    <div class="page-content">

      


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Inner content -->
            <div class="content-inner">

              


                <!-- Content area -->
                <div class="content">

                    <!-- Main charts -->
                    <div class="row">
                        <div class="col-md-10 offset-md-1">

                            <!-- Traffic sources -->
                            <div class="card">

                                <div class="card-header" style="font-family: josefin-sans; font-size:12px">
                                    <h6 class="card-title text-center">XPERT SEO SERVICES</h6>
                                    <p class="text-center">16/d/3, DIN NATH SN ROAD, GANDRIA, DHAKA-1204</p>
                                    <p class="text-center">+880 194 555 0555</p>
                                    <p class="text-center" style="font-weight:bold">{{session()->get('purpose')}}</p>

                                </div>


                                <div class="card-body" style="text-transform: capitalize; font-size:12px">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="">From Date - <span style="font-size: 12px;">{{date('d-M-Y', strtotime($date_start))}}</span> </p>
                                            <p class="">To Date - <span style="font-size: 12px;">{{date('d-M-Y', strtotime($date_finished))}}</span> </p>
                                        </div>
                                        <div class="col-md-6">
                                            <table class=" table-bordered table-striped  text-center" >

                                                <thead>
                                                    <tr>
                                                        <th>Summery</th>
                                                        <th>Balances</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>OPENING</td>
                                                        <td>{{$debit_balance}}{{$credit_balance}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>DR</td>
                                                        <td>{{$sum_voucher_debit}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>CR</td>
                                                        <td>{{$sum_voucher_credit}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>BALANCE DR</td>
                                                        <td style="font-weight: bold;">= {{($debit_balance + $sum_voucher_debit)-($credit_balance + $sum_voucher_credit)}}</td>
                                                    </tr>

                                                </tbody>
                                            </table>

                                        </div>

                                    </div>
                                    <br>
                                    <br>






                                    <table class="table-bordered table-striped  text-center" >
                                       

                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>REF</th>

                                                <th>Particulars</th>
                                                <th>Related A/C</th>
                                                <th>DR.</th>
                                                <th>CR.</th>
                                            </tr>

                                        </thead>

                                        <tbody>
                                            @if($debit_balance == 0 && $credit_balance ==0 && $date == '')
                                            @else
                                            <tr>
                                                <td>{{date('d-M-Y', strtotime($date))}}</td>
                                                <td>-</td>
                                                <td>Opening Balance</td>
                                                <td>-</td>
                                                <td>{{$debit_balance}}</td>
                                                <td>{{$credit_balance}}</td>
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



                                                <td>
                                                    @foreach($voucher as $data)
                                                    @if($data->id == $item->voucher_id)
                                                    <p>{{$item->amount}}</p>
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



                                                <td>
                                                    @foreach($voucher as $data)
                                                    @if($data->id == $item->voucher_id)
                                                    <p>{{$item->amount}}</p>
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