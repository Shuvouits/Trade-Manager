<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Payroll | Distribution</title>
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
                                <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>Payroll</a>
                                <span class="breadcrumb-item active">Wages / Payroll Distribution</span>
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
                                    <form action="/payroll/payroll-distribution" method="post">
                                        {{@csrf_field()}}


                                        <fieldset>
                                            <legend class="font-weight-semibold">Wages/Payroll Distribution & IOU</legend>

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
                                                <label class="col-lg-3 col-form-label">Status</label>
                                                <div class="col-lg-9">
                                                    <div class="form-group">

                                                        <select class="form-control select-search" name="status" data-fouc required>
                                                            <option value="" selected disabled>--select--</option>
                                                            <option value="1" selected>Regular Payroll</option>
                                                            <option value="2">Payroll with Bonus</option>



                                                        </select>

                                                        @error('status')
                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>
                                            </div>





                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Date of Payment (M/D/Y)</label>
                                                <div class="col-lg-9">

                                                    <div class="input-group">

                                                        <span class="input-group-prepend">
                                                            <span class="input-group-text"><i class="icon-calendar22"></i></span>
                                                        </span>

                                                        <input type="text" name="date" class="form-control daterange-single" @if(Session::has('payroll_session_date_data'))  value={{session()->get('payroll_session_date_data')}}  @endif   required>
                                                       
                                                        @error('date')
                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Referrence</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="referrence" class="form-control"  @if(Session::has('payroll_session_referrence_data'))  value={{session()->get('payroll_session_referrence_data')}}  @endif  placeholder="Enter Referrence..." required>
                                                    @error('referrence')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label" for="account_id">Account ID</label>
                                                <div class="col-lg-9">
                                                    <div class="form-group">

                                                        <select class="form-control select-search" id="account_id" name="account_id" data-fouc required>
                                                            <option value="" selected disabled>--select account--</option>

                                                            <option value="111">Advance Payroll & Wages</option>
                                                            <option value="112">Loan Receivable HR</option>
                                                            <option value="114">Wages Payable</option>
                                                            <option value="115" selected>Payroll & Wages Payable</option>




                                                        </select>

                                                        @error('account_id')
                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label" for="hr">HR ID</label>
                                                <div class="col-lg-9">
                                                    <div class="form-group">

                                                        <select class="form-control select-search" name="hr" id="hr" data-fouc required>
                                                            <option value="" selected disabled>--select account--</option>

                                                            @foreach($hr as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach



                                                        </select>

                                                        @error('hr')
                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label" for="amount">Amount</label>
                                                <div class="col-lg-9">
                                                    <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter Amount..." required>
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
            $('#hr').on('change', function() {
               
                var hr = this.value;
                var account_id = $('#account_id').val();
                
                console.log(hr)

                $.ajax({

                    url: "{{url('/payroll/wage-distribution-payroll-ajax')}}",
                    type: "POST",
                    data: {
                        hr: hr,
                        account_id : account_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',



                    success: function(result) {
                        $('#amount').val(result);

                    }

                });


            });



        })
    </script>








</body>

</html>