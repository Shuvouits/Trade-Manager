<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Xpert SEO | Human Resource</title>
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
                <div class="content">

                    <!-- Main charts -->
                    <div class="row">
                        <div class="col-md-12">

                            <!-- Traffic sources -->
                            <div class="card">

                                <div class="card-header">
                                    <h2 class="card-title text-center"><b>Xpert SEO Service</b></h2>
                                    <p class="text-center">16/d/3, DIN NATH SN ROAD, GANDRIA, DHAKA-1204</p>
                                    <p class="text-center">+880 194 555 0555</p>
                                    <p class="text-center" style="font-weight:bold">LIST OF Humen Resource</p>





                                </div>




                                <div class="card-body">
                                    <table class="table  table-hover table-striped" style="font-size: 11px">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Deparment</th>
                                                <th>HR Name, Position & Qualification, Parents Name & Date of Birth</th>
                                                <th>Parents Name & Permanent Address, Contact Address & Number</th>
                                                <th>Joining Date</th>
                                                <th>Status</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-transform: uppercase;">
                                            @foreach($hr as $count=>$item)
                                            <tr>
                                                <td id="hr_id">M{{$item->hr_id}}</td>
                                                <td>
                                                    @foreach($department as $data)
                                                    @if($data->id == $item->joining_point)
                                                    <p>{{$data->department}}</p>
                                                    @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <p>{{$item->name}}</p>
                                                    @foreach($position as $data)
                                                    @if($data->id == $item->position)
                                                    <p>{{$data->position}}</p>
                                                    @endif
                                                    @endforeach
                                                    <p>{{$item->qualification}}</p>
                                                    <p>DOB:{{$item->birth_date}}</p>
                                                </td>

                                                <td>
                                                    <p>{{$item->parent_name}}</p>
                                                    <p>{{$item->permanent_address}}</p>
                                                    <p>{{$item->contact_address}}</p>
                                                    <p>{{$item->contact_number}}</p>
                                                </td>
                                                <td>
                                                    <p>{{$item->joining_date}}</p>
                                                </td>

                                                <td>


                                                    <div class="custom-control custom-switch custom-switch-square custom-control-success mb-2">

                                                        <input type="checkbox" name="hr" class="custom-control-input" id="s{{$item->id}}" @if($item->status == 'on' || $item->status == '') checked @else unchecked @endif value={{$item->id}}>
                                                        <label class="custom-control-label" for="s{{$item->id}}"></label>
                                                    </div>





                                                </td>

                                                <td class="text-center">
                                                    <div class="list-icons">
                                                        <div class="dropdown">
                                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="/initial/human-resource-view/edit/{{$item->id}}" class="dropdown-item"><i class="fa fa-pencil"></i> Edit</a>
                                                                <a href="/initial/human-resource-view/delete/{{$item->id}}" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>


                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>

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

    @foreach($hr as $item)

    <script>
        $(document).ready(function() {
            $('#s{{$item->id}}').on('change', function() {

                var hr = this.value;

                console.log(hr);

                $.ajax({

                    url: "{{url('/initial/human-resource/status')}}",
                    type: "POST",
                    data: {
                        hr: hr,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',

                });


            });



        })
    </script>

    @endforeach






</body>

</html>