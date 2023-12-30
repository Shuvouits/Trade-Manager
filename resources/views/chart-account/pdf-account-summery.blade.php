<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Chart of Accounts | Accounts Summery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


</head>

<body>

  


    <!-- Page content -->
    <div class="page-content">

     


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Inner content -->
            <div class="content-inner">

               


                <!-- Content area -->
                <div class="content">

                    <!-- Main charts -->
                    <div class="row">
                        <div class="col-md-6 offset-md-3">

                            <!-- Traffic sources -->
                            <div class="card">

                                <div class="card-header">
                                    <h4 class="card-title text-center"><b>Chart of Accounts</b></h4>
                                   
                                    <hr style="border: 1px solid black;">

                                </div>


                                <div class="card-body" style="font-size : 10px !important">
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