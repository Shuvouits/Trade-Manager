<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Xpert SEO | Payroll View</title>
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
                                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>Initial</a>
                                <span class="breadcrumb-item active">Human Resource Views</span>
                            </div>

                            <a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
                        </div>


                    </div>
                </div>
                <!-- /page header -->


                <!-- Content area -->
                <div class="content" id="content">

                    <!-- Main charts -->
                    <div class="row">



                        <div class="col-md-12">

                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title text-center"><b>Xpert SEO Service</b></h2>
                                    <p class="text-center">16/d/3, DIN NATH SN ROAD, GANDRIA, DHAKA-1204</p>
                                    <p class="text-center">+880 194 555 0555</p>
                                    <p class="text-center" style="font-weight:bold">Payroll Breakup</p>


                                </div>

                                <div class="card-body">


                                    <table class="table datatable-button-print-basic" style="font-size:13px">
                                        <thead>
                                            <tr>

                                                <th>position</th>

                                                <th>Basic</th>
                                                <th>HouseRent</th>
                                                <th>Medical</th>
                                                <th>Transport</th>
                                                <th>Mobile</th>
                                                <th>Total</th>
                                                <th>Festival-Bonus</th>
                                                <th>Incentive-Bonus</th>
                                                <th>OT-Rate</th>
                                                <th>Comphensation</th>
                                                <th>Loan</th>
                                                <th>Loan Adjust</th>
                                                <th class="text-center">Actions</th>





                                            </tr>


                                        </thead>
                                        <tbody>
                                            @foreach($payroll_breakup_basic as $item)
                                            <tr>
                                                <td>
                                                    @foreach($department as $data)
                                                    @if($data->id == $item->department)
                                                    {{$data->department}}
                                                    @endif
                                                    @endforeach
                                                    <br>


                                                    @foreach($hr as $data)
                                                    @if($data->id == $item->hr)
                                                    <span>{{$data->name}}</span>
                                                    @foreach($position as $value)
                                                    @if($value->id == $data->position)
                                                    -<span> {{$value->position}}</span>
                                                    @endif
                                                    @endforeach

                                                    @endif

                                                    @endforeach
                                                    <br>
                                                    {{$item->date}}



                                                </td>



                                                <td>
                                                   
                                                    {{$item->basic}}

                                                </td>

                                                <td>
                                                    {{$item->house_rent}}
                                                </td>

                                                <td>
                                                    {{$item->medical_allowance}}

                                                </td>
                                                <td>{{$item->transport}}</td>
                                                <td>{{$item->mobile_bill}}</td>
                                                <td> {{$item->basic + $item->house_rent + $item->medical_allowance + $item->transport + $item->mobile_bill}} </td>
                                                <td> {{$item->festival_bonus}} </td>
                                                <td>{{$item->incentive_bonus}}</td>
                                                <td>{{$item->over_time_rate}}</td>
                                                <td>{{$item->comphensation}}</td>
                                                <td>{{$item->loan_limit}}</td>
                                                <td>{{$item->loan_adjust}}</td>

                                                <td class="text-center">
                                                    <div class="list-icons">
                                                        <div class="dropdown">
                                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#edit{{$item->id}}"><i class="icon-pencil"></i> Edit</a>
                                                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#delete{{$item->id}}"><i class="fa fa-trash"></i> Delete</a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>


                                                <!----Edit Modal Start--->


                                                <div class="modal fade" id="edit{{$item->id}}">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">



                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <form action="/initial/edit-payroll-breakup-basic" method="post">
                                                                            {{@csrf_field()}}

                                                                            <input type="hidden" name="hr" value="{{$item->hr}}">


                                                                            <fieldset>
                                                                                <legend class="font-weight-semibold">Edit Payroll</legend>

                                                                                @foreach($hr as $data)

                                                                                @if($data->id == $item->hr)

                                                                                <div class="form-group row">
                                                                                    <label class="col-lg-3 col-form-label">Name</label>
                                                                                    <div class="col-lg-9">
                                                                                        <input type="text" name="name" class="form-control" value="{{$data->name}}" required>
                                                                                        @error('name')
                                                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>

                                                                                @endif

                                                                                @endforeach





                                                                                <div class="form-group row">
                                                                                    <label class="col-lg-3 col-form-label">Department</a> </label>
                                                                                    <div class="col-lg-9">
                                                                                        <select class="form-control select" name="department" data-fouc required>
                                                                                            <option value="" selected disabled>--select--</option>
                                                                                            @foreach($department as $value)
                                                                                            <option value="{{$value->id}}" @if($item->department == $value->id) selected @endif >{{$value->department}}</option>
                                                                                            @endforeach


                                                                                        </select>
                                                                                        @error('department')
                                                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>

                                                                                @foreach($hr as $data)

                                                                                @if($data->id == $item->hr)
                                                                                <div class="form-group row">
                                                                                    <label class="col-lg-3 col-form-label">HR ID</a> </label>
                                                                                    <div class="col-lg-9">

                                                                                        <input type="text" name="hr_id" class="form-control" value="{{$data->hr_id}}" readonly>
                                                                                        @error('hr_id')
                                                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                                                        @enderror


                                                                                    </div>
                                                                                </div>
                                                                                @endif 

                                                                                @endforeach

                                                                                

                                                                               
                                                                                <div class="form-group row">
                                                                                    <label class="col-lg-3 col-form-label">Basic</label>
                                                                                    <div class="col-lg-9">
                                                                                        <input type="number" step="any" name="basic" value="{{$item->basic}}" class="form-control" placeholder="Enter Basic Payroll" required>
                                                                                        @error('basic')
                                                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                               


                                                                                <div class="form-group row">
                                                                                    <label class="col-lg-3 col-form-label">House Rent</label>
                                                                                    <div class="col-lg-9">
                                                                                        <input type="number" step="any" name="house_rent" value="{{$item->house_rent}}" class="form-control" placeholder="Enter House Rent" required>
                                                                                        @error('house_rent')
                                                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label class="col-lg-3 col-form-label">Medical Allowance</label>
                                                                                    <div class="col-lg-9">
                                                                                        <input type="number" step="any" name="medical_allowance" value="{{$item->medical_allowance}}" class="form-control" placeholder="Enter Medical Allowance" required>
                                                                                        @error('medical_allowance')
                                                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label class="col-lg-3 col-form-label">Festival Bonus Limit</label>
                                                                                    <div class="col-lg-9">
                                                                                        <input type="number" step="any" name="festival_bonus" value="{{$item->festival_bonus}}" class="form-control" placeholder="Enter Festival Bonus Limit" required>
                                                                                        @error('festival_bonus')
                                                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label class="col-lg-3 col-form-label">Mobile Bill</label>
                                                                                    <div class="col-lg-9">
                                                                                        <input type="number" step="any" name="mobile_bill" value="{{$item->mobile_bill}}" class="form-control" placeholder="Enter Festival Bonus Limit" required>
                                                                                        @error('mobile_bill')
                                                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label class="col-lg-3 col-form-label">Advance Salary</label>
                                                                                    <div class="col-lg-9">
                                                                                        <input type="number" step="any" name="advance_salary" value="{{$item->advance_salary}}" class="form-control" placeholder="Enter Advance Salary" required>
                                                                                        @error('advance_salary')
                                                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>



                                                                                <div class="form-group row">
                                                                                    <label class="col-lg-3 col-form-label">Loan Limit</label>
                                                                                    <div class="col-lg-9">
                                                                                        <input type="number" step="any" name="loan_limit" value="{{$item->loan_limit}}" class="form-control" placeholder="Enter Loan Limit" required>
                                                                                        @error('loan_limit')
                                                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label class="col-lg-3 col-form-label">Loan Adjust</label>
                                                                                    <div class="col-lg-9">
                                                                                        <input type="number" step="any" name="loan_adjust" value="{{$item->loan_adjust}}" class="form-control" placeholder="Enter Loan Limit" required>
                                                                                        @error('loan_adjust')
                                                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label class="col-lg-3 col-form-label">Comphensation</label>
                                                                                    <div class="col-lg-9">
                                                                                        <input type="number" step="any" name="comphensation" value="{{$item->comphensation}}" class="form-control" placeholder="Enter Current Loan" required>
                                                                                        @error('comphensation')
                                                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label class="col-lg-3 col-form-label">Current Loan</label>
                                                                                    <div class="col-lg-9">
                                                                                        <input type="number" step="any" name="current_loan" value="{{$item->current_loan}}" class="form-control" placeholder="Enter Current Loan" required>
                                                                                        @error('current_loan')
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

                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>


                                                <!--End Modal-->

                                                <!---Delete Modal -->
                                                <div class="modal fade" id="delete{{$item->id}}">
                                                    <div class="modal-dialog modal-dialog-right modal-sm">
                                                        <div class="modal-content">

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <form action="/initial/payroll-breakup-basic/delete" method="post">
                                                                            {{@csrf_field()}}

                                                                            <input type="hidden"  name="id" value="{{$item->id}}">
                                                                            <button type="submit" class="btn btn-danger">DELETE</button>

                                                                        </form>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                 <!--End Modal-->








                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>







                                </div>





                            </div>

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