<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Xpert DIGITAL AGENCY | Chart Of Accounts</title>
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
                                <span class="breadcrumb-item active">Bank</span>
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
                                    <form action="/initial/bank-post" method="post">
                                        {{@csrf_field()}}


                                        <fieldset>
                                            <legend class="font-weight-semibold">Bank Details</legend>

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
                                                <label class="col-lg-3 col-form-label">Bank & Branch Name</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="bank_name" class="form-control" placeholder="Enter Bank & Branch Name" required>
                                                    @error('bank_name')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Date of Opening</label>
                                                <div class="col-lg-9">

                                                    <div class="input-group">

                                                        <span class="input-group-prepend">
                                                            <span class="input-group-text"><i class="icon-calendar22"></i></span>
                                                        </span>
                                                        <input type="text" name="date_opening" class="form-control daterange-single" required>
                                                        @error('date_complete')
                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Address</label>
                                                <div class="col-lg-9">
                                                    <textarea rows="3" cols="3" name="address" class="form-control" placeholder="Enter Address" required></textarea>
                                                </div>
                                                @error('address')
                                                <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Fax/Email/Swift</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="swift_code" class="form-control" placeholder="Enter Swift Code" required>
                                                    @error('swift_code')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Type of Account</label>
                                                <div class="col-lg-9">
                                                    <select class="form-control select" id="account_type" name="account_type" data-fouc required>
                                                        <option value="" selected disabled>--select--</option>
                                                        <option>current</option>
                                                        <option>savings</option>


                                                    </select>
                                                    @error('account_type')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Account Number</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="account_number" class="form-control" placeholder="Enter Account Number" required>
                                                    @error('account_number')
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
                                                        <a href="/initial/bank-details-view" class="btn btn-primary btn-light"><i class="icon-comment-discussion mr-1"></i>View</a>

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
            $('#project_owner').on('change', function() {
                var project_owner = this.value;
                console.log(project_owner);
                $("#project_type").html('');
                $.ajax({

                    url: "{{url('/initial/api/project')}}",
                    type: "POST",
                    data: {
                        project_owner: project_owner,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',



                    success: function(result) {

                        $('#project_type').html('<option value="" disabled selected>--choose--</option>');
                        $.each(result, function(key, value) {
                            $("#project_type").append('<option  value="' + value.id + '">' + value.name + '</option>');
                        });

                    }

                });


            });

        })
    </script>



</body>

</html>