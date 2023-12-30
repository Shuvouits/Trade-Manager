<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Chart of Accounts | Accounts Summery</title>
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
                                <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>Chart of Accounts</a>
                                <span class="breadcrumb-item active">Account Summery</span>
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
                                    <h4 class="card-title text-center"><b>Chart of Accounts</b></h4>
                                    <a href="/chart-account/account-summery-pdf" class="btn btn-primary">Download-PDF</a>
                                    <hr style="border: 1px solid black;">

                                </div>


                                <div class="card-body">
                                    @foreach($chart_parent as $count=>$item)
                                        <p><b>{{$count+1}}. <span style="margin-left:20px">{{$item->name}}</span></b></p>

                                        @foreach($chart_main as $data)
                                            @if($item->id == $data->parent_account)
                                                 <p style="margin-left:190px"><b>{{$data->name}}</b></p>

                                                     @foreach($chart_child as $value)
                                                           @if($value->main_account == $data->id)
                                                              <p style="margin-left:390px; border-bottom:1px solid black; width:30%"><span style="margin-left:10px"><b>{{$value->name}}</b></span></p>
                                                           @endif
                                                     @endforeach

                                            @endif
                                        @endforeach



                                    @endforeach
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