<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Coffee | Profit & Loss</title>
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
                                <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>Coffee</a>
                                <span class="breadcrumb-item active">Profit & Loss</span>
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

                        <div class="col-md-6">

                            <br>
                            <br>
                            <br>

                            <div class="card">

                                <div class="card-body">

                                    <fieldset>
                                        <form method="post" action="/coffee/income-filter-post">
                                            {{@csrf_field()}}
                                            <legend class="font-weight-semibold">Coffee / Income Filter</legend>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="input-group">

                                                        <span class="input-group-prepend">
                                                            <span class="input-group-text"><i class="icon-calendar22"></i></span>
                                                        </span>
                                                        <input type="text" name="start_date" class="form-control daterange-single" @if(Session::has('session_date_data')) value={{session()->get('session_date_data')}} @endif required>



                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="input-group">

                                                        <span class="input-group-prepend">
                                                            <span class="input-group-text"><i class="icon-calendar22"></i></span>
                                                        </span>
                                                        <input type="text" name="finished_date" class="form-control daterange-single" @if(Session::has('session_date_data')) value={{session()->get('session_date_data')}} @endif required>



                                                    </div>

                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-danger">Check</button>
                                                </div>
                                            </div>

                                        </form>


                                    </fieldset>
                                </div>


                            </div>


                            <!-- Traffic sources -->
                            <div class="card">

                                <div class="card-body">

                                    <fieldset>
                                        <legend class="font-weight-semibold">Coffee / Total Income ( {{ date ('d-M-Y', strtotime($start_date)) }} To {{ date ('d-M-Y', strtotime($finished_date)) }} )</legend>

                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <th>No</th>
                                                <th>User Name</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th>View</th>
                                            </thead>

                                            <tbody>
                                                @foreach($filter_month_income as $key=>$item)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$item->name}}</td>
                                                    <td class=""><span class="badge badge-danger" style="margin-left: 10px;">{{$item->total_quantity}}</span></td>

                                                    <td>{{$item->total_amount}} TK.</td>
                                                    <td><i style="cursor : pointer" class="fa fa-eye-slash" data-toggle="modal" data-target="#data{{$item->user_id}}"></i></td>

                                                </tr>
                                                @endforeach


                                                <tr>
                                                    <td></td>
                                                    <td></td>

                                                    <td></td>
                                                    <td style="font-weight: bold; color : green">Total = {{$total_amount_coffee_income}}</td>

                                                </tr>

                                            </tbody>

                                        </table>


                                    </fieldset>
                                </div>


                            </div>
                            <!-- /traffic sources -->



                        </div>

                        <div class="col-md-6">

                            <br>
                            <br>
                            <br>

                            <div class="card">

                                <div class="card-body">

                                    <fieldset>
                                        <form method="post" action="/coffee/income-filter-post">
                                            {{@csrf_field()}}
                                            <legend class="font-weight-semibold">Coffee / Expense Filter</legend>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="input-group">

                                                        <span class="input-group-prepend">
                                                            <span class="input-group-text"><i class="icon-calendar22"></i></span>
                                                        </span>
                                                        <input type="text" name="start_date" class="form-control daterange-single" @if(Session::has('session_date_data')) value={{session()->get('session_date_data')}} @endif required>



                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="input-group">

                                                        <span class="input-group-prepend">
                                                            <span class="input-group-text"><i class="icon-calendar22"></i></span>
                                                        </span>
                                                        <input type="text" name="finished_date" class="form-control daterange-single" @if(Session::has('session_date_data')) value={{session()->get('session_date_data')}} @endif required>



                                                    </div>

                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-danger">Check</button>
                                                </div>
                                            </div>

                                        </form>


                                    </fieldset>
                                </div>


                            </div>


                            <!-- Traffic sources -->
                            <div class="card">

                                <div class="card-body">

                                    <fieldset>

                                        <legend class="font-weight-semibold">Coffee / Total Expense ( {{ date ('d-M-Y', strtotime($start_date)) }} To {{ date ('d-M-Y', strtotime($finished_date)) }} )</legend>

                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <th>No</th>
                                                <th>Element</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                            </thead>

                                            <tbody>
                                                @foreach($coffee_expenses as $key=>$item)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$item->element}}</td>
                                                    <td>{{$item->amount}}</td>
                                                    <td>{{date('d-M-Y', strtotime($item->date))}}</td>

                                                </tr>


                                                @endforeach

                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td style="font-weight: bold; color : green">Total = {{$total_amount_coffee_expenses}}</td>
                                                    <td></td>

                                                </tr>

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

    <!---View modal---->
    @foreach($filter_month_history as $key=>$item)


    <div class="modal fade" id="data{{$item->user_id}}">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">



                <!-- Modal body -->
                <div class="modal-body">

                    <div class="card">

                        <div class="card-body">

                            <fieldset>
                                <legend class="font-weight-semibold">Monthly History of <span style="font-size: 13px; color : green">{{$item->name}}</span> </legend>

                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>

                                    </thead>

                                    <tbody>

                                        @php
                                        $specific_user_data = App\Models\CoffeeIncome::where('user_id', $item->user_id)->get();
                                        @endphp

                                        @foreach($specific_user_data as $key=>$data)

                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{date('d-M-Y', strtotime($item->date))}}</td>
                                            <td class=""><span class="badge badge-danger" style="margin-left: 10px;">{{$data->quantity}}</span></td>

                                            <td>{{$data->amount}} TK.</td>


                                        </tr>

                                        @endforeach


                                    </tbody>

                                </table>

                            </fieldset>
                        </div>


                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    @endforeach

    <!---End view Modal---->




    <!--purpose for live search -->

    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

    <!--purpose for live search END-->



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

    @if(Session::has('error'))
    <script>
        Swal.fire({
            toast: true,
            icon: 'error',
            //title: 'Ooops invalid !! error your email or password',
            title: "{{ session()->get('error') }}",
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