<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Accounts | Other Account</title>
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
                                <span class="breadcrumb-item active">Other Accounts</span>
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
                                    <form action="/accounts/other-account" method="post">
                                        {{@csrf_field()}}


                                        <fieldset>
                                            <legend class="font-weight-semibold">Accounts/Other Accounts</legend>

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
                                                <label class="col-lg-3 col-form-label">Referrence</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="referrence" class="form-control" placeholder="Enter Referrence" required>
                                                    @error('referrence')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label" for="month">Project/Job</label>
                                                <div class="col-lg-9">
                                                    <div class="form-group">

                                                        <select class="form-control select" id="project" name="project" data-fouc required>
                                                            <option value="" selected disabled>--select--</option>
                                                            @foreach($all_project as $item)
                                                            <option value="{{$item->id}}">{{$item->project_name}}</option>
                                                            @endforeach

                                                        </select>

                                                        @error('project')
                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label" for="month">Account DR</label>
                                                <div class="col-lg-9">
                                                    <div class="form-group">

                                                        <select class="form-control select-search" id="account_dr" name="account_dr" data-fouc required>
                                                            <option value="" selected disabled>--select--</option>
                                                            @foreach($chart_child as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach


                                                        </select>
                                                        @error('account_dr')
                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group row" style="display:none" id="sub_account_id">
                                                <label class="col-lg-3 col-form-label" for="month">Sub Account ID</label>
                                                <div class="col-lg-9">
                                                    <div class="form-group">

                                                        <select class="form-control select-search" id="sub_account_data" name="sub_account_id" data-fouc required>


                                                        </select>

                                                        @error('sub_account_id')
                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label" for="account_cr">Account CR</label>
                                                <div class="col-lg-9">
                                                    <div class="form-group">

                                                    <select class="form-control select-search" id="account_cr" name="account_cr" data-fouc required>
                                                            <option value="" selected disabled>--select--</option>
                                                            @foreach($chart_child as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach


                                                        </select>
                                                        @error('account_cr')
                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                        @enderror

                                                        

                                                    </div>

                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Amount</label>
                                                <div class="col-lg-9">
                                                    <input type="number" step="any" name="amount" class="form-control" placeholder="Enter the amount" required>
                                                    @error('company_name')
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
                                                        <a href="/payroll/job-record-history" type="submit" class="btn btn-primary btn-light"><i class="icon-comment-discussion mr-1"></i>History</a>

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
            $('#account_dr').on('change', function() {
                var account_dr = this.value;
                console.log(account_dr);

                if (account_dr == 83) {
                    $('#sub_account_id').show();

                    $.ajax({

                        url: "{{url('/accounts/other-account-bank-post')}}",
                        type: "POST",
                        data: {
                            account_dr: account_dr,
                            _token: '{{csrf_token()}}'
                        },
                        dataType: 'json',



                        success: function(result) {

                            $('#sub_account_data').html('<option value="" disabled selected>--choose--</option>');


                            $.each(result, function(key, value) {
                                $("#sub_account_data").append('<option  value="' + value.id + '">' + value.bank_name + '</option>');
                            });


                        }

                    });


                } else if (account_dr == 81) {

                    $('#sub_account_id').hide();

                } else {
                    $('#sub_account_id').show();

                    $.ajax({

                        url: "{{url('/accounts/other-account-all-post')}}",
                        type: "POST",
                        data: {
                            account_dr: account_dr,
                            _token: '{{csrf_token()}}'
                        },
                        dataType: 'json',



                        success: function(result) {

                            $('#sub_account_data').html('<option value="" disabled selected>--choose--</option>');


                            $.each(result, function(key, value) {
                                $("#sub_account_data").append('<option  value="' + value.id + '">' + value.patron_name + '</option>');
                            });


                        }

                    });

                }
            });
        })
    </script>





</body>

</html>