<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>XPERT | DIGITAL | AGENCY</title>
    @include('link')

</head>

<body>

    <!-- Main navbar -->

    <!-- /main navbar -->


    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Inner content -->
            <div class="content-inner">

                <!-- Content area -->
                <div class="content d-flex justify-content-center align-items-center">

                    <!-- Login form -->
                    <form class="login-form" action="/auth-post" method="post">
                        {{@csrf_field()}}
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <i class="icon-reading icon-2x text-secondary border-secondary border-3 rounded-pill p-3 mb-3 mt-1"></i>
                                    <h5 class="mb-0">Login to your account</h5>
                                    <span class="d-block text-muted">Enter your credentials below</span>
                                </div>

                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input type="text" name="mobile_number" class="form-control" placeholder="Mobile Number" required>
                                    <div class="form-control-feedback">
                                        <i class="icon-mobile text-muted"></i>
                                    </div>
                                    @error('mobile_number')
                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>

                                    @error('password')
                                    <span style="color:red; font-weight:bold; font-family:josefin-sans">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                                </div>


                            </div>
                        </div>
                    </form>
                    <!-- /login form -->

                </div>
                <!-- /content area -->



            </div>
            <!-- /inner content -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

    @if(Session::has('error'))
    <script>
        Swal.fire({
            toast: true,
            icon: 'error',
            //title: 'Ooops invalid !! error your email or password',
            title: "{{ session()->get('error') }}",
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