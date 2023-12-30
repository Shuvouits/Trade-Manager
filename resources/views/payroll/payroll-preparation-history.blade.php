<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>XPERT DIGITAL AGENCY | Chart Of Accounts</title>
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
                                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>Payroll</a>
                                <span class="breadcrumb-item active">Job Record</span>
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

                            <br>
                            <br>
                            <br>


                            <!-- Traffic sources -->
                            <div class="card">

                                <div class="card-body">




                                    <fieldset>
                                        <legend class="font-weight-semibold">Payroll/Job Record History</legend>


                                        <table class="table datatable-basic table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>HR Name</th>
                                                    <th>Date of Preparation</th>
                                                    <th>Month</th>
                                                    <th>Absent</th>
                                                    <th>Working Days</th>
                                                    <th>Other Benifit</th>
                                                    <th>Other Deduction</th>
                                                    <th>Incentive</th>
                                                    <th>OverTime</th>
                                                    <th>Loan Adjust</th>
                                                    <th>Advance Salary</th>
                                                    <th>Total</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach($job_record as $count=>$item)
                                                <tr>
                                                    <td>{{$count+1}}</td>
                                                    <td>
                                                        @foreach($hr as $data)
                                                           @if($data->id == $item->hr)
                                                              {{$data->name}}
                                                           @endif
                                                        @endforeach
                                                        
                                                    </td>
                                                    <td>{{date('d-M-Y', strtotime($item->date))}}</td>
                                                    <td>
                                                        @foreach($month as $data)
                                                           @if($data->id == $item->month)
                                                              {{$data->name}}
                                                           @endif
                                                        @endforeach
                                                      
                                                    </td>
                                                    <td>{{$item->absent}}</td>
                                                    <td>{{$item->work_day}}</td>
                                                    <td>{{$item->other_benifit}} </td>
                                                    <td>{{$item->other_deduction}} </td>
                                                    <td>{{$item->incentive}}</td>
                                                    <td>{{$item->over_time}}</td>
                                                    <td>{{$item->loan_adjust}}</td>
                                                    <td>{{$item->advance_salary}}</td>
                                                    <td>{{$item->due_net_payroll}}</td>
                                                    <td class="text-center">
                                                        <div class="list-icons">
                                                            <div class="dropdown">
                                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                                    <i class="icon-menu9"></i>
                                                                </a>

                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a href="#" class="dropdown-item"><i class="icon-pencil"></i> Export to .pdf</a>
                                                                    <a href="#" class="dropdown-item"><i class="icon-trash"></i>Delete</a>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                               
                                               
                                            </tbody>
                                        </table>



                                    </fieldset>





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