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
                                <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Initial</a>
                                <span class="breadcrumb-item active">HR</span>
                                <span class="breadcrumb-item active">Payroll Deduction</span>
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


                            <!-- Traffic sources -->
                            <div class="card">

                                <div class="card-body">
                                    <form action="/initial/payroll-breakup-deduction-post" method="post">
                                        {{@csrf_field()}}


                                        <fieldset>
                                            <legend class="font-weight-semibold">Payroll Deduction</legend>

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
                                                <label class="col-lg-3 col-form-label">Department</a> </label>
                                                <div class="col-lg-9">
                                                    <select class="form-control select" id="department" name="department" data-fouc required>
                                                        <option value="" selected disabled>--select--</option>
                                                        @foreach($department as $item)
                                                           <option value="{{$item->id}}">{{$item->department}}</option>
                                                        @endforeach
                                                       

                                                    </select>
                                                    @error('department')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">HR ID</a> </label>
                                                <div class="col-lg-9">
                                                    <select class="form-control select-search" id="hr" name="hr" data-fouc required>
                                                        <option value="" selected disabled>--select--</option>
                                                       

                                                    </select>
                                                    @error('hr')
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
                                                <label class="col-lg-3 col-form-label">Loan Limit</label>
                                                <div class="col-lg-9">
                                                    <input type="number" step="any" name="loan_limit" class="form-control" placeholder="Enter Loan Limit" required>
                                                    @error('loan_limit')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>





                                            
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Loan Adjust/Month</label>
                                                <div class="col-lg-9">
                                                    <input type="number" step="any" name="loan_adjust" class="form-control" placeholder="Enter Loan Adjustment/Month" required>
                                                    @error('loan_adjust')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Provident Fund</label>
                                                <div class="col-lg-9">
                                                    <input type="number" step="any" name="provident_fund" class="form-control" placeholder="Enter Provident Fund" required>
                                                    @error('provident_fund')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Insurance</label>
                                                <div class="col-lg-9">
                                                    <input type="number" step="any" name="insurance" class="form-control" placeholder="Enter Insurance" required>
                                                    @error('insurance')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Income Tax</label>
                                                <div class="col-lg-9">
                                                    <input type="number" step="any" name="income_tax" class="form-control" placeholder="Enter Income Tax" required>
                                                    @error('income_tax')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Comphensation/Day</label>
                                                <div class="col-lg-9">
                                                    <input type="number" step="any" name="comphensation" class="form-control" placeholder="Enter Comphensation/Day" required>
                                                    @error('comphensation')
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
                                                        <a href="/initial/payroll-breakup-view" class="btn btn-primary btn-danger"><i class="icon-comment-discussion mr-1"></i>View</a>

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


    <script>
        $(document).ready(function() {
            $('#department').on('change', function() {
                var department = this.value;
                console.log(department);
                $("#hr").html('');
                $.ajax({

                    url: "{{url('/initial/api/payroll-breakup')}}",
                    type: "POST",
                    data: {
                        department: department,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',



                    success: function(result) {

                        $('#hr').html('<option value="" disabled selected>--choose--</option>');
                        $.each(result, function(key, value) {
                            $("#hr").append('<option  value="' + value.id + '">' + value.name + '</option>');
                        });

                    }

                });


            });

        })
    </script>



</body>

</html>