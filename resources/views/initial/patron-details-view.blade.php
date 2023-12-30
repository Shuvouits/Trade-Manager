<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Xpert SEO | List Of Patron</title>
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
                                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>Patron</a>
                                <span class="breadcrumb-item active">List Of Patron</span>
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
                                    <p class="text-center" style="font-weight:bold">Patron Details</p>

                                </div>


                                <div class="card-body">



                                    <table class="table datatable-basic  table-hover table-striped " style="font-size: 12px;">
                                        <thead>
                                            <th>#</th>
                                            <th>Patron-Name</th>
                                            <th>Address & Contact Details</th>
                                            <th>Patron Status</th>
                                            <th>Patron Category</th>
                                            <th>Introducing Date</th>
                                            <th>Limit</th>
                                            <th>Action</th>


                                        </thead>
                                        <tbody>

                                            @foreach($patron_details as $count=>$item)
                                            <tr>
                                                <td>{{$count+1}}</td>
                                                <td>{{$item->patron_name}}</td>
                                                <td>
                                                    {{$item->address_1}} / {{$item->address_1}}
                                                </td>
                                                <td>
                                                    @foreach($patron_status as $value)
                                                    @if($value->id == $item->patron_status)
                                                    {{$value->status}}
                                                    @endif
                                                    @endforeach



                                                </td>
                                                <td>
                                                    @foreach($patron_category as $data)

                                                    @if($data->id == $item->patron_category)
                                                    {{$data->name}}
                                                    @endif

                                                    @endforeach

                                                </td>
                                                <td>{{$item->date_introducing}}</td>
                                                <td>{{$item->transaction_limit}}</td>

                                                <td class="text-center">
                                                    <div class="list-icons">
                                                        <div class="dropdown">
                                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                                                <a href="/initial/patron-details-view-delete/{{$item->id}}" class="dropdown-item"><i class="icon-trash"></i>Delete</a>

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

</body>

</html>