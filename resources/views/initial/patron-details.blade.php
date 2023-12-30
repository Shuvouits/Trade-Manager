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
                                <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>Initial</a>

                                <span class="breadcrumb-item"><a href="/initial/project" style="color:white">Project</a></span>
                                <span class="breadcrumb-item active">Patron Details</span>
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
                                    <form method="post" action="/initial/patron-details-post">
                                        {{@csrf_field()}}

                                        <fieldset>
                                            <legend class="font-weight-semibold">Patron Details</legend>

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
                                                <label class="col-lg-3 col-form-label">Patron Status</label>
                                                <div class="col-lg-9">

                                                    <select class="form-control select" id="patron_status" name="patron_status" data-fouc required>
                                                        <option value="" selected disabled>--select status--</option>
                                                        @foreach($patron_status as $item)
                                                        <option value="{{$item->id}}">{{$item->status}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('patron_status')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">
                                                    Patron Category
                                                    <a href="/initial/patron-category" style="color:black"><i class="icon-plus-circle2" style="margin-left:12px"></i></a>
                                                </label>
                                                <div class="col-lg-9">
                                                    <select class="form-control select" id="patron_category" name="patron_category" data-fouc required>
                                                        <option value="" selected disabled>--select category--</option>

                                                    </select>
                                                    @error('patron_category')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Name of Patron</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="patron_name" class="form-control" placeholder="Enter Patron Name" required>
                                                    @error('patron_name')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Date Introducing</label>
                                                <div class="col-lg-9">

                                                    <div class="input-group">

                                                        <span class="input-group-prepend">
                                                            <span class="input-group-text"><i class="icon-calendar22"></i></span>
                                                        </span>
                                                        <input type="text" name="date_introducing" class="form-control daterange-single" required>
                                                        @error('date_introducing')
                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Address 1</label>
                                                <div class="col-lg-9">
                                                    <textarea rows="3" name="address_1" cols="3" class="form-control" placeholder="Enter Address" required></textarea>
                                                </div>
                                                @error('address_1')
                                                <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                @enderror
                                            </div>

                                           

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Contact Number</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="contact_number" class="form-control" placeholder="Enter Contact Number" required>
                                                    @error('contact_number')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Maximum Transaction Limit</label>
                                                <div class="col-lg-9">
                                                    <input type="number" step="any" name="transaction_limit" class="form-control" placeholder="Enter Transaction Limit" required>
                                                    @error('transaction_limit')
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
                                                        <a href="/initial/patron-details-view" class="btn btn-primary btn-danger"><i class="icon-comment-discussion mr-1"></i>View</a>

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
            $('#patron_status').on('change', function() {
                var patron_status = this.value;
                console.log(patron_status);
                $("#patron_category").html('');
                $.ajax({

                    url: "{{url('/initial/api/fetch-data')}}",
                    type: "POST",
                    data: {
                        patron_status: patron_status,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',



                    success: function(result) {

                        $('#patron_category').html('<option value="" disabled selected>--choose--</option>');
                        $.each(result, function(key, value) {
                            $("#patron_category").append('<option  value="' + value.id + '">' + value.name + '</option>');
                        });

                    }

                });


            });

        })
    </script>



</body>

</html>