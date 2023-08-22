
<!doctype html>
<html lang="en">

    
<!-- Mirrored from themesdesign.in/apaxy/layouts/vertical/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Mar 2023 22:02:59 GMT -->
<head>
        <meta charset="utf-8" />
        <title>POS-LAUNDRI | LOGIN</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ url('public') }}/assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="{{ url('public') }}/assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- Icons Css -->
        <link href="{{ url('public') }}/assets/css/icons.min.css" rel="stylesheet">
        <!-- App Css-->
        <link href="{{ url('public') }}/assets/css/app.min.css" rel="stylesheet">

    </head>

    <body class="bg-primary bg-pattern">
        
        <div class="account-pages my-5 pt-5">
            <div class="container">
                
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="p-2">
                                    <h5 class="mb-5 text-center">Silahkan login menggunakan akun anda !</h5>
                                    <form class="form-horizontal"  action="#">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group mb-4">
                                                    <label for="username">Username</label>
                                                    <input type="text" class="form-control" id="username" placeholder="Enter username">
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="userpassword">Password</label>
                                                    <input type="password" class="form-control" id="userpassword" placeholder="Enter password">
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customControlInline">
                                                            <label class="custom-control-label" for="customControlInline">Remember me</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="text-md-right mt-3 mt-md-0">
                                                            <a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <button class="btn btn-success btn-block waves-effect waves-light" type="submit">Log In</button>
                                                </div>
                                                <div class="mt-4 text-center d-flex justify-content-center">
                                                    <a href="/auth/google" class="btn btn-danger">
                                                        Register  Google
                                                    </a>
                                                    <br>
                                                    <a href="{{ url('/auth/provider') }}" class="btn btn-dark ml-3">
                                                        Register   GitHub
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- end Account pages -->

        <!-- JAVASCRIPT -->
        <script src="{{ url('public') }}/assets/libs/jquery/jquery.min.js"></script>
        <script src="{{ url('public') }}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{ url('public') }}/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="{{ url('public') }}/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="{{ url('public') }}/assets/libs/node-waves/waves.min.js"></script>

        <script src="{{ url('public') }}/assets/js/app.js"></script>

    </body>

<!-- Mirrored from themesdesign.in/apaxy/layouts/vertical/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Mar 2023 22:02:59 GMT -->
</html>
