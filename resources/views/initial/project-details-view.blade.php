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
                                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>Project</a>
                                <span class="breadcrumb-item active">List Of Project Type</span>
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
                                    <p class="text-center" style="font-weight:bold">LIST OF PROJECT</p>
                                    <hr style="border: 2px solid black;">
                                     <div class="row">
                                        <div class="col-md-1">
                                            <b>SL#</b>
                                        </div>
                                        <div class="col-md-2">
                                            <p style="text-transform: uppercase;"><b>Project Owner</b></p>
                                        </div>

                                        <div class="col-md-1">
                                            <p style="text-transform: uppercase;"><b>Project Type</b></p>
                                            
                                        </div>

                                        <div class="col-md-1">
                                            <p style="text-transform: uppercase;"><b>Date Start</b></p>
                                            
                                        </div>

                                        <div class="col-md-1">
                                            <p style="text-transform: uppercase;"><b>Date End</b></p>
                                            
                                        </div>

                                        <div class="col-md-1">
                                            <p style="text-transform: uppercase;"><b>Project Name</b></p>
                                            
                                        </div>

                                        <div class="col-md-1">
                                            <p style="text-transform: uppercase;"><b>Project Incharge</b></p>
                                            
                                        </div>

                                        <div class="col-md-2">
                                            <p style="text-transform: uppercase;"><b>Project Address</b></p>
                                            
                                        </div>

                                        <div class="col-md-1">
                                            <p style="text-transform: uppercase;"><b>Contact</b></p>
                                            
                                        </div>

                                        <div class="col-md-1">
                                            <p style="text-transform: uppercase;"><b>Referrence</b></p>
                                            
                                        </div>


                                     </div>
                                    
                                    <hr style="border: 1px solid black;">

                                </div>


                                <div class="card-body">

                                     @foreach($project as $count=>$item)
                                        <div class="row">
                                            <div class="col-md-1">
                                                <p>{{$count + 1}}</p>

                                            </div>

                                            <div class="col-md-2">
                                                @foreach($patron_details as $data)
                                                    @if($data->id == $item->project_owner)
                                                       <p>{{$data->patron_name}}</p>
                                                    @endif
                                                @endforeach
                                              
                                              

                                            </div>

                                            <div class="col-md-1">
                                                @foreach($project_type as $data) 
                                                   @if($data->id == $item->project_type)
                                                      <p>{{$data->name}}</p>
                                                   @endif
                                                @endforeach
                                               
                                            </div>

                                            <div class="col-md-1">
                                                <p>{{$item->date_start}}</p>

                                            </div>

                                            <div class="col-md-1">
                                                <p>{{$item->date_complete}}</p>

                                            </div>

                                           

                                            <div class="col-md-1">
                                                <p>{{$item->project_name}}</p>

                                            </div>

                                            <div class="col-md-1">
                                                <p>{{$item->project_incharge}}</p>

                                            </div>

                                            <div class="col-md-2">
                                                <p>{{$item->project_address}}</p>

                                            </div>

                                            <div class="col-md-1">
                                                <p>{{$item->contact}}</p>

                                            </div>

                                            <div class="col-md-1">
                                                <p>{{$item->project_referrence}}</p>

                                            </div>


                                        </div>
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