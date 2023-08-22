
<!doctype html>
<html lang="en">

    
<!-- Mirrored from themesdesign.in/apaxy/layouts/vertical/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Mar 2023 22:02:21 GMT -->
<head>
        <meta charset="utf-8" />
        <title>POS LAUNDRI || ADMIN</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ url('public') }}/assets/images/favicon.ico">

        <!-- Summernote css -->
        <link href="{{ url('public') }}/assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />

        <!-- slick css -->
        <link href="{{ url('public') }}/assets/libs/slick-slider/slick/slick.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('public') }}/assets/libs/slick-slider/slick/slick-theme.css" rel="stylesheet" type="text/css" />

        <!-- jvectormap -->
        <link href="{{ url('public') }}/assets/libs/jqvmap/jqvmap.min.css" rel="stylesheet" />

        <!-- Bootstrap Css -->
        <link href="{{ url('public') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ url('public') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        {{-- Data table --}}
        <link href="{{ url('public') }}/assets/dataTable/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('public') }}/assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            @include('layouts.header')

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                        @include('layouts.sidebar')
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                        @foreach (['success', 'danger', 'warning', 'info'] as $status)
                            @if (session($status))
                            <div class="alert alert-{{ $status }} alert-dismissible fade" role="alert">
                                @if ($status == 'success')
                                    <i class="mdi mdi-check-all me-2"></i>
                                    @else
                                    <i class="mdi mdi-alert-circle-outline me-2"></i>
                                @endif
                                
                                {{ session($status) }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                                
                            @endif
                        @endforeach
                        
                        @yield('content')
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                @php echo date('Y-m-d') @endphp
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-right d-none d-sm-block">
                                    Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="#">MARISA</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

       

      

        <!-- JAVASCRIPT -->
        <script src="{{ url('public') }}/assets/libs/jquery/jquery.min.js"></script>
        <script src="{{ url('public') }}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{ url('public') }}/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="{{ url('public') }}/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="{{ url('public') }}/assets/libs/node-waves/waves.min.js"></script>

        <!-- apexcharts -->
        <script src="{{ url('public') }}/assets/libs/apexcharts/apexcharts.min.js"></script>

        <script src="{{ url('public') }}/assets/libs/slick-slider/slick/slick.min.js"></script>

        <!-- Jq vector map -->
        <script src="{{ url('public') }}/assets/libs/jqvmap/jquery.vmap.min.js"></script>
        <script src="{{ url('public') }}/assets/libs/jqvmap/maps/jquery.vmap.usa.js"></script>

        <!-- Summernote js -->
        <script src="{{ url('public') }}/assets/libs/summernote/summernote-bs4.min.js"></script>

        <!-- init js -->
        <script src="{{ url('public') }}/assets/js/pages/summernote.init.js"></script>

        <script src="{{ url('public') }}/assets/js/pages/dashboard.init.js"></script>

        <script src="{{ url('public') }}/assets/js/app.js"></script>
        {{-- Data Table JS --}}
        <script src="{{ url('public') }}/assets/dataTable/jquery.dataTables.min.js"></script>
        <script src="{{ url('public') }}/assets/dataTable/dataTables.bootstrap4.min.js"></script>
        <script>
            new DataTable('.dataTable');
        </script>


    </body>

<!-- Mirrored from themesdesign.in/apaxy/layouts/vertical/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Mar 2023 22:02:46 GMT -->
</html>
