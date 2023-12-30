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
                                <span class="breadcrumb-item active">Project</span>
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
                                    <form action="/initial/project" method="post">
                                        {{@csrf_field()}}


                                        <fieldset>
                                            <legend class="font-weight-semibold">Project Details</legend>

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
                                                <label class="col-lg-3 col-form-label">Project/Job Owner ID <a href="/initial/patron-details" style="color:black"><i class="icon-plus-circle2" style="margin-left:12px"></i></a></label>

                                                <div class="col-lg-9">
                                                    <select class="form-control select" id="project_owner" name="project_owner" data-fouc required>
                                                        <option value="" selected disabled>--select--</option>
                                                        @foreach($patron_details as $item)
                                                            
                                                        <option value="{{$item->id}}">{{$item->patron_name}}</option>
                                                        @endforeach

                                                    </select>
                                                    @error('project_owner')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror


                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Project/Job Type <a href="/initial/project-type" style="color:black"><i class="icon-plus-circle2" style="margin-left:12px"></i></a> </label>
                                                <div class="col-lg-9">
                                                    <select class="form-control select" id="project_type" name="project_type" data-fouc required>
                                                        <option value="" selected disabled>--select--</option>

                                                    </select>
                                                    @error('project_type')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Date Start</label>
                                                <div class="col-lg-9">

                                                    <div class="input-group">

                                                        <span class="input-group-prepend">
                                                            <span class="input-group-text"><i class="icon-calendar22"></i></span>
                                                        </span>
                                                        <input type="text" name="date_start" class="form-control daterange-single" required>
                                                        @error('date_start')
                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>
                                            </div>







                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Date Completed</label>
                                                <div class="col-lg-9">

                                                    <div class="input-group">

                                                        <span class="input-group-prepend">
                                                            <span class="input-group-text"><i class="icon-calendar22"></i></span>
                                                        </span>
                                                        <input type="text" name="date_complete" class="form-control daterange-single" required>
                                                        @error('date_complete')
                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Project/Job Name</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="project_name" class="form-control" placeholder="Enter Project Name" required />
                                                    @error('project_name')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Project/Job Incharge</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="project_incharge" class="form-control" placeholder="Enter Project Incharge" required />
                                                    @error('project_incharge')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Project/Job Address</label>
                                                <div class="col-lg-9">
                                                    <textarea rows="3" cols="3" name="project_address"  class="form-control" placeholder="Enter your message here" required></textarea>
                                                </div>
                                                @error('project_address')
                                                <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Contact Person & Contact</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="contact" class="form-control" placeholder="Enter Email or Phone Number" required>

                                                    @error('contact')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>










                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Project/Job Referrence</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="project_referrence" class="form-control" placeholder="Enter Project Referrence" required />
                                                    @error('project_referrence')
                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Project/Job Value (BDT)</label>
                                                <div class="col-lg-9">
                                                    <input type="number" step="any" name="project_value" class="form-control" placeholder="Enter Project Value" required />
                                                    @error('project_value')
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
                                                        <a href="/initial/project-details-view" class="btn btn-primary btn-danger"><i class="icon-comment-discussion mr-1"></i>View</a>

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