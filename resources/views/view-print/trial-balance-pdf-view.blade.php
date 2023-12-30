<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Xpert Digital Agency | Trial Balance</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .table td,
        .table th {
            padding: 2px !important;
           
        }
    </style>

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

                                <div class="card-header" style="font-size: 12px;">
                                    <h5 class="card-title text-center"><b>Xpert Digital Agency</b></h5>
                                    <p class="text-center">16/d/3, DIN NATH SN ROAD, GANDRIA, DHAKA-1204, Hot Line :+880 194 555 0555 </p>
                                    <p class="text-center" style="font-weight:bold">Trial Balance (From : {{date('d-M-Y', strtotime($date_start))}} To : {{date('d-M-Y', strtotime($date_finished))}}) </p>
                                   
                                </div>


                                <div class="card-body" style="font-size : 10px !important">
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

                                                <td>

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