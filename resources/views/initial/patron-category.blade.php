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
                                <span class="breadcrumb-item active"><a href="/initial/project" style="color:white">Project</a></span>
                                <span class="breadcrumb-item active"><a href="/initial/patron-details" style="color:white">Patron Details</a></span>
                                <span class="breadcrumb-item active">Patron Category</span>
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

                            <!-- Traffic sources -->
                            <div class="card">

                                <div class="card-body">
                                    <form action="/initial/patron-category-add" method="post">
                                        {{@csrf_field()}}

                                       


                                        <fieldset>
                                            <legend class="font-weight-semibold">Patron Category</legend>

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
                                                <label class="col-lg-3 col-form-label">Patron-Status <a href="#" style="color:black" data-toggle="modal" data-target="#patron-status"><i class="icon-plus-circle2" style="margin-left:12px"></i></a> </label>
                                                <div class="col-lg-9">
                                                    <select class="form-control select" id="patron_status" name="patron_status" data-fouc required>
                                                        <option value="" selected disabled>--select--</option>
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
                                                <label class="col-lg-3 col-form-label">Name Of Patron</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="patron_category" class="form-control" placeholder="Enter Patron Status Name" required>

                                                    @error('patron_category')
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
                                                        <a href="/initial/patron-status-view" class="btn btn-primary btn-danger"><i class="icon-comment-discussion mr-1"></i>View</a>

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


    <!-- The Modal -->
    <div class="modal" id="patron-status">
        <div class="modal-dialog">
            <div class="modal-content">



                <!-- Modal body -->
                <div class="modal-body">

                    <form method="post" action="/initial/patron-status-add">
                        {{@csrf_field()}}

                        <fieldset>
                            <legend class="font-weight-semibold">Add Patron Status</legend>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Company Name</label>
                                <div class="col-lg-9">
                                    <input type="text" name="company_name" class="form-control" placeholder="Enter Company Name" required>
                                    @error('company_name')
                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Status Name</label>
                                <div class="col-lg-9">
                                    <input type="text" name="status" class="form-control" placeholder="Enter Status Name" required>
                                    @error('status')
                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>





                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-success"><i class="icon-comment-discussion mr-1"></i>Submit</button>

                            </div>




                        </fieldset>

                    </form>

                </div>



            </div>
        </div>
    </div>









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