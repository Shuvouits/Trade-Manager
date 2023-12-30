<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Opening | Balance | Patron</title>
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
                                <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>Accounts</a>
                                <span class="breadcrumb-item active"> Patron Opening Balance</span>
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

                        <div class="col-md-8 offset-md-2">

                            <br>
                            <br>
                            <br>


                            <!-- Traffic sources -->
                            <div class="card">

                                <div class="card-body">
                                    <form action="/accounts/patron-opening-balance" method="post">
                                        {{@csrf_field()}}


                                        <fieldset>
                                            <legend class="font-weight-semibold">Accounts / Patron Opening Balance</legend>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Company Name</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="company_name" class="form-control" value="XPERT DIGITAL AGENCY" required>
                                                    @error('company_name')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Date</label>
                                                <div class="col-lg-9">

                                                    <div class="input-group">

                                                        <span class="input-group-prepend">
                                                            <span class="input-group-text"><i class="icon-calendar22"></i></span>
                                                        </span>
                                                        <input type="text" name="date" class="form-control daterange-single" required>
                                                        @error('date')
                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Patron ID</label>
                                                <div class="col-lg-9">
                                                    <div class="form-group">

                                                        <select class="form-control select-search" name="patron_id"  data-fouc required>
                                                            <option value="" selected disabled>--select account--</option>
                                                            @foreach($all_patron as $item)
                                                            <option value="{{$item->id}}">{{$item->patron_name}}</option>
                                                            @endforeach

                                                        </select>

                                                        @error('patron_id')
                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>
                                            </div>

                                           

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Balance Option</label>
                                                <div class="col-lg-9">
                                                    <div class="form-group">

                                                        <select class="form-control select-search" id="balance_option" name="balance_option" data-fouc required>
                                                            <option value="" selected disabled>--select--</option>
                                                            <option value="1">Debit</option>
                                                            <option value="2">Credit</option>
                                                        </select>

                                                        @error('balance_option')
                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Amount</label>
                                                <div class="col-lg-9">
                                                    <input type="number" step="any" name="amount" class="form-control"  placeholder="Enter your amount" required>
                                                    @error('amount')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>



                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-primary btn-success"><i class="icon-comment-discussion mr-1"></i>Submit</button>

                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="text-right">
                                                        <a href="#" class="btn btn-primary btn-light" data-toggle="modal" data-target="#myModal"><i class="icon-comment-discussion mr-1"></i>History</a>

                                                    </div>
                                                </div>



                                            </div>



                                        </fieldset>


                                    </form>


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

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">

               

                <!-- Modal body -->
                <div class="modal-body">
                    <table class="table  datatable-basic table-striped table-hover">
                        <thead>
                            <th>Serial No</th>
                            <th>Date</th>
                            <th>Account</th>
                            <th>Debit Balance</th>
                            <th>Credit Balance</th>
                            <th class="text-center">Action</th>
                        </thead>
                        <tbody>
                            @foreach($patron_opening_balance as $count=>$item)
                            <tr>
                                <td>{{$count+1}}</td>
                                <td>{{$item->date}}</td>
                                <td>
                                    {{$item->patron_name}}
                                    <span class="ml-1">
                                      
                                    </span>
                                </td>
                                <td>{{$item->debit_balance}}</td>
                                <td>{{$item->credit_balance}}</td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right">

                                                <a href="/accounts/patron-opening-balance-delete/{{$item->id}}" class="dropdown-item"><i class="icon-trash"></i>Delete</a>

                                            </div>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <!--end modal -->

   



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