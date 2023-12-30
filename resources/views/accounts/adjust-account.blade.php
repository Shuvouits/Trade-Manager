<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Accounts | Account Adjust</title>
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
                                <span class="breadcrumb-item active">Adjust Account</span>
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

                                    <form action="/accounts/adjust-account-post" method="post">
                                        {{@csrf_field()}}

                                        <input type="hidden" name="voucher_type" value="0">


                                        <fieldset>
                                            <legend class="font-weight-semibold">Accounts / Adjust Account</legend>



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
                                                <label class="col-lg-3 col-form-label">Voucher Type</label>
                                                <div class="col-lg-9">
                                                    <div class="form-group">

                                                        <select class="form-control select-search" name="voucher_type" data-fouc required>
                                                            <option value="" selected disabled>--select--</option>
                                                            <option value="0">Receive</option>
                                                            <option value="1">Payment</option>




                                                        </select>
                                                        @error('voucher_type')
                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>
                                            </div>





                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Mode of Transaction</label>
                                                <div class="col-lg-9">
                                                    <div class="form-group">

                                                        <select class="form-control select-search" id="transaction_mode" name="transaction_mode" data-fouc required>
                                                            <option value="" selected disabled>--select--</option>
                                                            @foreach($transaction_mode as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach



                                                        </select>
                                                        @error('transaction_mode')
                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label" for="account_id">Account ID</label>
                                                <div class="col-lg-9">
                                                    <div class="form-group">

                                                        <select class="form-control select-search"  name="account_id" data-fouc required>
                                                            <option value="" selected disabled>--select--</option>
                                                            @foreach($chart_child as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach

                                                        </select>
                                                        @error('account_id')
                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Additional Account ID</label>
                                                <div class="col-lg-9">
                                                    <div class="form-group">

                                                        <select class="form-control select-search" name="additional_account_id" data-fouc required>
                                                            <option value="" selected disabled>--select--</option>
                                                            @foreach($chart_child as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>

                                                        @error('additional_account_id')
                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                        @enderror

                                                    </div>

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
                                                        <a href="/accounts/adjust-account-history" type="submit" class="btn btn-primary btn-light"><i class="icon-comment-discussion mr-1"></i>History</a>

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