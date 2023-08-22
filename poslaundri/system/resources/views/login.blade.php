<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>POS || LAUNDRY</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('public') }}/assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="{{ url('public') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ url('public') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ url('public') }}/assets/css/app.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="bg-primary bg-pattern">

    <div class="account-pages my-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <a href="index.html" class="logo"><img src="{{ url('public') }}/assets/images/logo-light.png"
                                height="24" alt="logo"></a>
                        <h5 class="font-size-16 text-white-50 mb-4">ADMIN POS LAUNDRY</h5>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="p-2">
                                <h5 class="mb-5 text-center">Silahkan login menggunakan akun anda</h5>
                                @foreach (['success', 'danger', 'warning', 'info'] as $status)
                                    @if (session($status))
                                        <div class="alert alert-{{ $status }} alert-dismissible fade show"
                                            role="alert">
                                            @if ($status == 'success')
                                                <i class="mdi mdi-check-all"></i>
                                            @else
                                                <i class="mdi mdi-alert-circle-outline"></i>
                                            @endif

                                            {{ session($status) }}
                                        </div>
                                    @endif
                                @endforeach
                                
                                <form action="{{ url('/aksiLogin') }}" method="POST" class="mb-5">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-4">
                                                <label for="username">Email</label>
                                                <input type="email" name="email" class="form-control" id="username"
                                                    placeholder="Enter email">
                                                  @error('email')
                                                       <p class="text-right text-danger">{{ $message }}</p>
                                                  @enderror
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="userpassword">Password</label>
                                                <input type="password" name="password" class="form-control"
                                                    id="userpassword" placeholder="Enter password">
                                                    @error('password')
                                                       <p class="text-right text-danger">{{ $message }}</p>
                                                  @enderror
                                            </div>

                                            <div class="mt-4">
                                                <button type="submit"
                                                    class="btn btn-success btn-block waves-effect waves-light"
                                                    type="submit">Log In</button>
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

</html>
