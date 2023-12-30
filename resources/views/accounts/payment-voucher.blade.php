<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Accounts | Payment Voucher</title>
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
                                <span class="breadcrumb-item active">Payment Voucher</span>
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
                                    <form action="/accounts/payment-voucher-post" method="post">
                                        {{@csrf_field()}}

                                        <input type="hidden" name="voucher_type" value="1">


                                        <fieldset>
                                            <legend class="font-weight-semibold">Accounts / Payment-Voucher</legend>

                                            <div class="validator">

                                                <p>
                                                    @error('amount_cash')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </p>

                                                <p>
                                                    @error('amount_bank')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </p>

                                                <p>
                                                    @error('bank_id')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </p>

                                                <p>
                                                    @error('amount_credit')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </p>



                                                <p>
                                                    @error('amount_dues')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </p>


                                            </div>

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
                                                        <input type="text" name="date" class="form-control daterange-single" @if(Session::has('session_date_data'))  value={{session()->get('session_date_data')}}  @endif   required>
                                                        @error('date')
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
                                                <label class="col-lg-3 col-form-label">Referrence</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="referrence" class="form-control" @if(Session::has('session_referrence_number'))  value={{session()->get('session_referrence_number')}}  @endif  placeholder="Enter Referrence" required>
                                                    @error('referrence')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Project/Job-ID</label>
                                                <div class="col-lg-9">
                                                    <div class="form-group">

                                                        <select class="form-control select-search" name="project_id" data-fouc required>
                                                            <option value="" selected disabled>--select--</option>
                                                            @foreach($project as $item)
                                                            <option value="{{$item->id}}">{{$item->project_name}}</option>
                                                            @endforeach


                                                        </select>
                                                        @error('project_id')
                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Account-ID</label>
                                                <div class="col-lg-9">
                                                    <div class="form-group">

                                                        <select class="form-control select-search" name="account_id" id="account_id" data-fouc required>
                                                            <option value="" selected disabled>--select--</option>

                                                        </select>
                                                        @error('account_id')
                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>
                                            </div>

                                            <div id="sub_account_id" style="display:none">


                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Sub-Account-ID</label>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <select class="form-control select-search" name="sub_account_id" id="sub_account_id_data">
                                                                <option selected disabled value="">--select--</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>






                                            <div id="credit" style="display: none;">
                                                <hr>

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Total Amount</label>
                                                    <div class="col-lg-9">
                                                        <div class="form-group">
                                                            <input type="number" step="any" class="form-control" name="amount_credit" placeholder="Enter Total Amount">
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>


                                            <div id="cash" style="display:none">
                                                <hr>

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Total Cash</label>
                                                    <div class="col-lg-9">
                                                        <div class="form-group">
                                                            <input type="number" step="any" class="form-control" name="amount_cash" placeholder="Enter the Amount">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                            <div id="bank" style="display:none">
                                                <hr>

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Total Amount</label>
                                                    <div class="col-lg-9">
                                                        <div class="form-group">
                                                            <input type="number" step="any" class="form-control" name="amount_bank" placeholder="Enter the Amount">
                                                        </div>



                                                    </div>



                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Bank Name</label>
                                                    <div class="col-lg-9">
                                                        <div class="form-group">

                                                            <select class="form-control select-search" name="bank_id" data-fouc>
                                                                <option value="" selected disabled>--select Bank--</option>
                                                                @foreach($bank as $item)
                                                                <option value="{{$item->id}}">{{$item->bank_name}}</option>
                                                                @endforeach


                                                            </select>



                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">REF # Cheque Number</label>

                                                    <div class="col-lg-9">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="cheque" placeholder="Enter Cheque Number">
                                                        </div>
                                                    </div>

                                                    @error('cheque')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror

                                                </div>

                                            </div>

                                            <div id="dues" style="display: none;">
                                                <hr>


                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Amount</label>
                                                    <div class="col-lg-9">
                                                        <div class="form-group">
                                                            <input type="number" step="any" class="form-control" name="amount_dues" placeholder="Enter Total Amount">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Bank Name</label>
                                                    <div class="col-lg-9">
                                                        <div class="form-group">

                                                            <select class="form-control select-search" name="bank_id" data-fouc>
                                                                <option value="" selected disabled>--select Bank--</option>
                                                                @foreach($bank as $item)
                                                                <option value="{{$item->id}}">{{$item->bank_name}}</option>
                                                                @endforeach


                                                            </select>
                                                            @error('bank_id')
                                                            <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                            @enderror

                                                        </div>

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
                                                        <a href="/accounts/payment-voucher-view" class="btn btn-primary btn-light"><i class="icon-comment-discussion mr-1"></i>View</a>

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





    <script>
        $(document).ready(function() {
            $('#transaction_mode').on('change', function() {
                var transaction_mode = this.value;
                console.log(transaction_mode);

                $('#sub_account_id').hide();

                if (transaction_mode == 1) {

                    $.ajax({

                        url: "{{url('/accounts/payment-cash-post')}}",
                        type: "POST",
                        data: {
                            transaction_mode: transaction_mode,
                            _token: '{{csrf_token()}}'
                        },
                        dataType: 'json',



                        success: function(result) {

                            $('#account_id').html('<option value="" disabled selected>--choose--</option>');
                            $('#cash').show();
                            //$('#cash').html('');

                            $.each(result, function(key, value) {
                                $("#account_id").append('<option  value="' + value.child_account + '">' + value.child_account_name + '</option>');
                            });

                            $('#bank').hide();
                            $('#credit').hide();
                            $('#dues').hide();

                        }

                    });


                    // $('#cash').html('<div class="form-group row"><label class="col-lg-3 col-form-label">Total Cash</label><div class="col-lg-9"><input type="text" name="total_cash" class="form-control" placeholder="Enter Total Cash" required></div></div>');

                } else if (transaction_mode == 2) {

                    $.ajax({

                        url: "{{url('/accounts/payment-bank-post')}}",
                        type: "POST",
                        data: {
                            transaction_mode: transaction_mode,
                            _token: '{{csrf_token()}}'
                        },
                        dataType: 'json',



                        success: function(result) {


                            $('#bank').show();
                            //$('#bank').html(' ');

                            $('#cash').hide();
                            $('#credit').hide();
                            $('#dues').hide();

                            $('#account_id').html('<option value="" disabled selected>--choose--</option>');

                            $.each(result, function(key, value) {
                                $("#account_id").append('<option  value="' + value.child_account + '">' + value.child_account_name + '</option>');
                            });

                        }

                    });

                } else if (transaction_mode == 3) {


                    $.ajax({

                        url: "{{url('/accounts/payment-credit-post')}}",
                        type: "POST",
                        data: {
                            transaction_mode: transaction_mode,
                            _token: '{{csrf_token()}}'
                        },
                        dataType: 'json',



                        success: function(result) {



                            $('#credit').show();
                            //$('#credit').html('');
                            $('#cash').hide();
                            $('#dues').hide();
                            $('#bank').hide();


                            $('#account_id').html('<option value="" disabled selected>--choose--</option>');

                            $.each(result, function(key, value) {

                                $("#account_id").append('<option  value="' + value.child_account + '">' + value.child_account_name + '</option>');
                            });

                        }

                    });




                } else if (transaction_mode == 4) {


                    $.ajax({

                        url: "{{url('/accounts/payment-dues-post')}}",
                        type: "POST",
                        data: {
                            transaction_mode: transaction_mode,
                            _token: '{{csrf_token()}}'
                        },
                        dataType: 'json',



                        success: function(result) {


                            $('#dues').show();

                            //$('#dues').html('');

                            $('#cash').hide();
                            $('#credit').hide();
                            $('#bank').hide();

                            $('#account_id').html('<option value="" disabled selected>--choose--</option>');


                            $.each(result, function(key, value) {
                                $("#account_id").append('<option  value="' + value.child_account + '">' + value.child_account_name + '</option>');
                            });



                        }

                    });




                }

            });



        })
    </script>

    <script>
        $('#account_id').on('change', function() {
            var transaction_mode = $('#transaction_mode').val();
            var account_id = this.value;
            console.log(account_id);
            console.log(transaction_mode);


            if (account_id == 83) {
                $('#bank').show();
                $('#cash').hide();

                //$('#bank').html('<div class="form-group row"> <label class="col-lg-3 col-form-label">Bank Name</label> <div class="col-lg-9"><div class="form-group"><input type="text" class="form-control" name="bank_name" required></div></div></div>     <div class="form-group row"> <label class="col-lg-3 col-form-label">Bank ID</label> <div class="col-lg-9"><div class="form-group"><input type="text" class="form-control" name="bank_id" required></div></div></div>  <div class="form-group row"> <label class="col-lg-3 col-form-label">REF # Cheque Number</label> <div class="col-lg-9"><div class="form-group"><input type="text" class="form-control" name="cheque_number" required></div></div></div> ');

            } else {
                //$('#bank').hide();
                //$('#cash').show();

            }

            $.ajax({

                url: "{{url('/accounts/sub-account-id')}}",
                type: "POST",
                data: {
                    account_id: account_id,
                    transaction_mode: transaction_mode,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',



                success: function(result) {

                    if (result.length == 0) {
                        $('#sub_account_id').hide();
                        $('#sub_account_id_data').hide();
                    } else {

                        $('#sub_account_id').show();
                        $('#sub_account_id_data').show();

                    }





                    $.each(result, function(key, value) {
                        $("#sub_account_id_data").append('<option  value="' + value.id + '">' + value.patron_name + '</option>');
                    });




                }

            });





        });
    </script>









</body>

</html>