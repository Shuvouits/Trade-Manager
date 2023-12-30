<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Xpert SEO | Payroll-Sheet</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>




</head>

<body>



    <!-- Page content -->
    <div class="page-content" style="font-family: josefin-sans;">




        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Inner content -->
            <div class="content-inner">




                <!-- Content area -->
                <div class="content">

                    <div class="text-center">
                        <h4 class="card-title text-center">Xpert SEO Service</h4>
                        <p class="text-center">16/d/3, DIN NATH SN ROAD, GANDRIA, DHAKA-1204 (+880 194 555 0555)</p>

                        <p class="text-center" style="font-weight:bold">PAYROLL SHEET</p>
                        <p class="text-center">From - {{date('d-M-Y', strtotime($date_start))}}</p>

                    </div>

                    <table class="table-striped">

                        <thead style="border-bottom:1px solid black; font-size:13px">

                            <td>Basic</td>
                            <td>House<br>Rent</td>
                            <td>Medical</td>

                            <td>Over<br>Time</td>
                            <td>Festival<br>Bonus</td>
                            <td>Incentive<br>Bonus</td>
                            <td>Mobile</td>
                            <td>Other<br>Benifit</td>
                            <td>Gross<br>Salary</td>
                            <td>Advance<br>Loan</td>
                            <td>Comphensation</td>
                            <td>Loan<br>Adjust</td>



                            <td>Other<br>Deduction</td>
                            <td>Advance<br>Salary</td>

                            <td>Dues<br>Payroll</td>

                        </thead>
                        <tbody style="font-size: 10px;">
                            @foreach($job_record as $item)

                            <tr class="text-center">
                                <td colspan="15">


                                    @foreach($hr as $data)
                                    @if($data->id == $item->hr)

                                    {{$data->name}}
                                    @endif
                                    @endforeach



                                </td>

                            </tr>
                            <tr style="border-bottom:1px solid black">




                                <td>{{$item->basic}}</td>

                                <td>{{$item->house_rent}}</td>
                                <td>{{$item->medical_allowance}}</td>

                                <td>
                                    @if($item->over_time == 0)
                                    @else 
                                    {{$item->over_time}}
                                    @endif
                                    
                                </td>
                                <td>

                                    @if($item->festival_bonus == 0)
                                    @else 
                                    {{$item->festival_bonus}}
                                    @endif

                                    
                                </td>
                                <td>

                                    @if($item->incentive == 0)
                                    @else 
                                    {{$item->incentive}}
                                    @endif

                                    
                                </td>
                                <td>

                                    @if($item->mobile == 0)
                                    @else 
                                    {{$item->mobile}}
                                    @endif


                                   
                                </td>
                                <td>

                                    @if($item->other_benifit == 0)
                                    @else 
                                    {{$item->other_benifit}}
                                    @endif

                                    
                                </td>
                                <td>{{$item->gross_salary}}</td>
                                <td>

                                    @if($item->advance == 0)
                                    @else 
                                    {{$item->advance}}
                                    @endif

                                    
                                </td>
                                <td>

                                    @if($item->comphensation == 0)
                                    @else 
                                    {{$item->comphensation}}
                                    @endif


                                    
                                </td>
                                <td>

                                    @if($item->loan_adjust == 0)
                                    @else 
                                    {{$item->loan_adjust}}
                                   
                                    @endif


                                    
                                </td>



                                <td>

                                    @if($item->other_deduction == 0)
                                    @else 
                                    {{$item->other_deduction}}
                                   
                                    @endif

                                    
                                </td>
                                <td>


                                    @if($item->advance_salary == 0)
                                    @else 
                                    {{$item->advance_salary}}
                                   
                                    @endif

                                    
                                </td>

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

                                <td>Total</td>

                                <td>{{$job_record_total}}</td>



                            </tr>
                        </tbody>

                    </table>

                    




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