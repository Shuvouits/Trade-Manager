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
                        <div class="col-md-10 offset-md-1">

                            <!-- Traffic sources -->
                            <div class="card">

                                <div class="card-header">
                                    <h2 class="card-title text-center"><b>Xpert SEO Service</b></h2>
                                    <p class="text-center">16/d/3, DIN NATH SN ROAD, GANDRIA, DHAKA-1204</p>
                                    <p class="text-center">+880 194 555 0555</p>
                                    <h6 class="text-center" style="font-weight:bold">ORGANOGRAM</h6>
                                    <p class="text-center" style="font-weight:bold">MONTHLY BASIS</p>
                                    <hr style="border: 2px solid black;">
                                     <div class="row">

                                       

                                        <div class="col-md-1">
                                            <b>SL#</b>

                                        </div>
                                        
                                        <div class="col-md-3">
                                             <p style="text-align:center; font-weight:bold;text-transform:uppercase">Department</p>
                                        </div>

                                        <div class="col-md-6">
                                            <p style="text-align:center; font-weight:bold;text-transform:uppercase">Position</p>
                                        </div>

                                      

                                     </div>
                                    
                                    <hr style="border: 1px solid black;">

                                </div>


                                <div class="card-body">
                                    @foreach($department as $count=>$item)
                                       <div class="row">

                                          <div class="col-md-1">
                                            <b>{{$count+1}}</b>

                                          </div>
                                          
                                          <div class="col-md-3">
                                                <p style="text-align:center; font-weight:bold;text-transform:uppercase">{{$item->department}}</p>
                                               
                                              
                                          </div>

                                          <div class="col-md-6">
                                            
                                              @foreach($position as $data)
                                                 @if($data->department == $item->id)
                                                
                                                    <p style="text-align:center; font-weight:bold;text-transform:uppercase;border-bottom:1px solid black">{{$data->position}}</p>
                                                 @endif
                                              @endforeach
                                              <br>
                                              <br>
                                              
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