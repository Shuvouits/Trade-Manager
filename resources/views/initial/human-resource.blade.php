<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Xpert SEO | Chart Of Accounts</title>
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
                                <span class="breadcrumb-item active">Human Resource</span>
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
                                    <form action="/initial/human-resource" method="post">
                                        {{@csrf_field()}}


                                        <fieldset>
                                            <legend class="font-weight-semibold">Human Resource</legend>

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
                                                <label class="col-lg-3 col-form-label">Name</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="name" class="form-control" placeholder="Enter Employee Name" required>
                                                    @error('name')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Date of birth</label>
                                                <div class="col-lg-9">

                                                    <div class="input-group">

                                                        <span class="input-group-prepend">
                                                            <span class="input-group-text"><i class="icon-calendar22"></i></span>
                                                        </span>
                                                        <input type="text" name="birth_date" class="form-control daterange-single" required>
                                                        @error('birth_date')
                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Father & Mother Name</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="parent_name" class="form-control" placeholder="Enter Parent Name" required>
                                                    @error('parent_name')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Date of joining</label>
                                                <div class="col-lg-9">

                                                    <div class="input-group">

                                                        <span class="input-group-prepend">
                                                            <span class="input-group-text"><i class="icon-calendar22"></i></span>
                                                        </span>
                                                        <input type="text" name="joining_date" class="form-control daterange-single" required>
                                                        @error('joining_date')
                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Permanent Address</label>
                                                <div class="col-lg-9">
                                                    <textarea rows="3" cols="3" name="permanent_address" class="form-control" placeholder="Enter your message here" required></textarea>
                                                </div>
                                                @error('permanent_address')
                                                <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Contact Address</label>
                                                <div class="col-lg-9">
                                                    <textarea rows="3" cols="3" name="contact_address" class="form-control" placeholder="Enter your message here" required></textarea>
                                                </div>
                                                @error('contact_address')
                                                <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                @enderror
                                            </div>

                                          

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Contact Number</label>
                                                <div class="col-lg-9">
                                                    <input type="number" name="contact_number" class="form-control" placeholder="Enter Contact Number" required>
                                                    @error('contact_number')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Qualification</label>
                                                <div class="col-lg-9">
                                                    <textarea rows="3" cols="3" name="qualification" class="form-control" placeholder="Enter your message here" required></textarea>
                                                </div>
                                                @error('qualification')
                                                <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Joining Point</label>
                                                <div class="col-lg-9">
                                                    <select class="form-control select"  data-fouc required>
                                                        <option value="" selected disabled>--select--</option>
                                                         <option>FAB CBD</option>
                                                         <option>CORPORATE</option>
                                                         <option>HEAD OFFICE</option>

                                                    </select>
                                                </div>
                                            </div>


                                            <!---Imagine that is joining point -->
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Department</label>
                                                <div class="col-lg-9">
                                                    <select class="form-control select" id="joining_point" name="joining_point" data-fouc required>
                                                        <option value="" selected disabled>--select--</option>
                                                        @foreach($department as $item)
                                                            <option value="{{$item->id}}">{{$item->department}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                             <!---End of Imagine that is joining point -->







                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Position</label>
                                                <div class="col-lg-9">
                                                    <select class="form-control select" id="position" name="position" data-fouc required>
                                                        <option value="" selected disabled>--select--</option>
                                                       

                                                    </select>
                                                    @error('position')
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
                                                        <a href="/initial/human-resource-view" class="btn btn-primary btn-danger"><i class="icon-comment-discussion mr-1"></i>View</a>

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
            $('#joining_point').on('change', function() {
                var joining_point = this.value;
                console.log(joining_point);
                $("#position").html('');
                $.ajax({

                    url: "{{url('/initial/api/hr')}}",
                    type: "POST",
                    data: {
                        joining_point: joining_point,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',



                    success: function(result) {

                        $('#position').html('<option value="" disabled selected>--choose--</option>');
                        $.each(result, function(key, value) {
                            $("#position").append('<option  value="' + value.id + '"> '  + value.position + '</option>');
                        });

                    }

                });


            });

        })
    </script>



</body>

</html>