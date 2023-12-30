<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Xpert SEO | Transaction-Mode </title>
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
                                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Chart of Accounts</a>
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

                        <div class="col-md-8 offset-md-2">

                            <br>
                            <br>
                            <br>


                            <!-- Traffic sources -->
                            <div class="card">

                                <div class="card-body">
                                    <form action="/chart-account/transaction-mode-update" method="post">
                                        {{@csrf_field()}}

                                        <input type="hidden" value="{{$id}}" name="id">


                                        <fieldset>
                                            <legend class="font-weight-semibold">Chart of Account / Transaction Mode</legend>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Company Name</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="company_name" class="form-control" value="XPERT SEO SERVICE" required>
                                                    @error('company_name')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Select Account</label>
                                                <div class="col-lg-9">
                                                    <div class="form-group">

                                                        <select class="form-control select-search" name="child_account" data-fouc required>
                                                            <option value="" selected disabled>--select--</option>


                                                            @foreach($chart_child as $item)
                                                            <option value="{{$item->id}}" @if($item->id == $child_account) selected @endif   >{{$item->name}}</option>
                                                            @endforeach



                                                        </select>
                                                        @error('child_account')
                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Transaction Mode</label>
                                                <div class="col-lg-9">
                                                    <select class="form-control select-search" name="transaction_mode" data-fouc required>
                                                        <option value="" selected disabled>--select--</option>
                                                        @foreach($transaction_mode_data as $item)
                                                        <option value="{{$item->id}}"  @if($item->id == $transaction_mode) selected @endif  >{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('transaction_mode')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Patron Zone</label>
                                                <div class="col-lg-9">
                                                    <select class="form-control select-search" name="patron_zone" data-fouc>
                                                        <option value="" selected disabled>--select--</option>
                                                        @foreach($patron_zone as $item)
                                                        <option value="{{$item->id}}"  @if($item->id == $patron_status) selected @endif  >{{$item->status}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Voucher Type</label>
                                                <div class="col-lg-9">
                                                    <select class="form-control select" name="voucher_type" data-fouc required>
                                                        

                                                    
                                                            <option value="0" @if($voucher_type =='0') selected @endif >Receive Voucher</option>
                                                    
                                                            <option value="1"  @if($voucher_type =='1') selected @endif  >Payment Voucher</option>
                                                        
                                                    

                                                    </select>

                                                    @error('voucher_type')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                            </div>


                                            <div class="row">

                                               



                                                <div class="col-md-12">
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary btn-success"><i class="icon-comment-discussion mr-1"></i>Update</button>

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