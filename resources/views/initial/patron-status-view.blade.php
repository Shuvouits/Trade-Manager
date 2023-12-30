<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Xpert SEO | Patron Category</title>
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
                                <span class="breadcrumb-item active">Patron Status</span>
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
                        <div class="col-md-10 offset-md-1">

                            <!-- Traffic sources -->
                            <div class="card">

                                <div class="card-header">
                                    <h2 class="card-title text-center"><b>Xpert SEO Service</b></h2>
                                    <p class="text-center">16/d/3, DIN NATH SN ROAD, GANDRIA, DHAKA-1204</p>
                                    <p class="text-center">+880 194 555 0555</p>
                                </div>


                                <div class="card-body">


                                    <table class="table table-hover table-striped" style="font-size:12px">
                                        <thead>
                                            <th>#</th>
                                            <th>Patron Status</th>
                                            <th>Zone Name</th>
                                            <th>Created AT</th>
                                        </thead>
                                        <tbody>
                                            @foreach($patron_status as $count=>$item)
                                            <tr>

                                                <td>{{$count+1}}</td>
                                                <td>{{$item->status}}</td>
                                                <td>
                                                    @foreach($patron_category as $value)
                                                    @if($item->id == $value->patron_status)
                                                    {{$value->name}}
                                                    <hr>
                                                    @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach($patron_category as $value)
                                                    @if($item->id == $value->patron_status)
                                                    {{$value->created_at}}
                                                    <hr>
                                                    @endif
                                                    @endforeach
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

</body>

</html>