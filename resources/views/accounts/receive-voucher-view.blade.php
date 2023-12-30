<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Xpert SEO | Journal View</title>
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

                            <!-- journal card -->
                            <div class="card">

                                <div class="card-header" style="font-size: 11px;">
                                    <h2 class="card-title text-center"><b>Xpert SEO Service</b></h2>
                                    <p class="text-center">16/d/3, DIN NATH SN ROAD, GANDRIA, DHAKA-1204</p>
                                    <p class="text-center">+880 194 555 0555</p>
                                    <p class="text-center" style="font-weight:bold">All Payment Voucher</p>


                                </div>



                                <div class="card-body" style="font-size: 11px;">

                                    <table class="table  datatable-basic table-striped table-hover">
                                        <thead>
                                            <th>Date</th>
                                            <th>Ref</th>
                                            <th>Particulars</th>
                                            <th>Related A/C</th>
                                            <th>HR</th>
                                            <th>DR</th>
                                            <th>CR</th>
                                            <th class="text-center">Action</th>
                                        </thead>

                                        <tbody>
                                            @foreach($voucher as $item)
                                            <tr>
                                                <td>{{date('d-M-Y', strtotime($item->date))}}</td>
                                                <td>{{$item->referrence}}</td>
                                                <td>
                                                    <div class="debit">
                                                        @foreach($voucher_debit as $data)
                                                        @if($data->voucher_id == $item->id)

                                                        @if($data->account_id == $item->account_id && $data->account_id !="")
                                                        <p>{{$item->account_name}}</p>
                                                        @endif

                                                        @if($data->transaction_mode == $item->transaction_mode && $data->transaction_mode !="")
                                                        <p>{{$item->transaction_mode_name}}</p>

                                                        @endif

                                                        @if($data->additional_account == $item->additional_account && $data->additional_account !="")
                                                        <p>{{$item->additional_account_name}}</p>
                                                        @endif

                                                        @endif
                                                        @endforeach

                                                    </div>

                                                    <div class="credit" style="margin-top:20px">
                                                        @foreach($voucher_credit as $data)
                                                        @if($data->voucher_id == $item->id)

                                                        @if($data->account_id == $item->account_id && $data->account_id !="")
                                                        <p>{{$item->account_name}}</p>
                                                        @endif

                                                        @if($data->transaction_mode == $item->transaction_mode && $data->transaction_mode !="")

                                                        <p>{{$item->transaction_mode_name}}</p>

                                                        @endif

                                                        @if($data->additional_account == $item->additional_account && $data->additional_account !="")
                                                        <p>{{$item->additional_account_name}}</p>
                                                        @endif

                                                        @endif
                                                        @endforeach

                                                    </div>

                                                </td>

                                                <td class="related-account">
                                                    <div class="debit">

                                                        @foreach($voucher_debit as $data)
                                                        @if($data->voucher_id == $item->id)

                                                        @if($data->sub_account_id == $item->sub_account_id)
                                                        <p>{{$item->sub_account_name}}</p>
                                                        @endif

                                                        @if($data->bank_id == $item->bank_id && $item->bank_id !='')
                                                        <p>{{$item->bank_name}}</p>
                                                        @endif

                                                        @endif
                                                        @endforeach

                                                    </div>

                                                    <div class="credit" style="margin-top:20px">

                                                        @foreach($voucher_credit as $data)
                                                        @if($data->voucher_id == $item->id)

                                                        @if($data->sub_account_id == $item->sub_account_id && $data->sub_account_id !="")
                                                        <p>{{$item->sub_account_name}}</p>
                                                        @endif

                                                        @if($data->bank_id == $item->bank_id && $item->bank_id !='')
                                                        <p>{{$item->bank_name}}</p>
                                                        @endif

                                                        @endif
                                                        @endforeach

                                                    </div>

                                                </td>
                                                <td>
                                                    @foreach($hr as $data)
                                                    @if($item->hr_id == $data->id)
                                                    <p>{{$data->name}}</p>
                                                    @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach($voucher_debit as $data)
                                                    @if($data->voucher_id == $item->id)
                                                    {{$data->amount}}

                                                    @endif
                                                    @endforeach
                                                </td>

                                                <td>
                                                    @foreach($voucher_credit as $data)
                                                    @if($data->voucher_id == $item->id)
                                                    {{$data->amount}}

                                                    @endif
                                                    @endforeach
                                                </td>

                                                <td class="text-center">
                                                    <div class="list-icons">
                                                        <div class="dropdown">
                                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-right">

                                                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#myModal{{$item->id}}"><i class="icon-trash"></i>Delete</a>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>

                                            <!-- The Modal -->
                                            <div class="modal fade" id="myModal{{$item->id}}">
                                                <div class="modal-dialog  modal-dialog-centered">
                                                    <div class="modal-content">



                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="card">

                                                                <div class="card-body">


                                                                    <form action="/accounts/journal/delete" method="post">
                                                                        {{@csrf_field()}}

                                                                        <input type="hidden" class="form-control" name="voucher_id" value="{{$item->id}}" class="form-control" required>


                                                                        <fieldset>
                                                                            <legend class="font-weight-semibold">Payment Voucher / Journal


                                                                            </legend>

                                                                            <div class="form-group row">
                                                                                <label class="col-lg-3 col-form-label">Company Name</label>
                                                                                <div class="col-lg-9">
                                                                                    <input type="text" name="company_name" class="form-control" value="XPERT SEO SERVICE" required>
                                                                                    @error('company_name')
                                                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label class="col-lg-3 col-form-label">Date</label>
                                                                                <div class="col-lg-9">

                                                                                    <div class="input-group">

                                                                                        <span class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="icon-calendar22"></i></span>
                                                                                        </span>
                                                                                        <input type="text" name="date" class="form-control daterange-single" required>
                                                                                        @error('date')
                                                                                        <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                                                        @enderror

                                                                                    </div>

                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label class="col-lg-3 col-form-label">Admin Password</label>
                                                                                <div class="col-lg-9">
                                                                                    <input type="password" name="password" class="form-control" required>
                                                                                    @error('password')
                                                                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">

                                                                                <div class="col-md-6">
                                                                                    <div class="text-right">
                                                                                        <button type="submit" class="btn btn-success"><i class="icon-comment-discussion mr-1"></i>Submit</button>

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
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <!-- End Modal -->
                                            @endforeach








                                        </tbody>

                                    </table>

                                </div>


                            </div>
                            <!-- /end journal card -->

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