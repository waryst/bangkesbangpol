<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pemilu | Dashboard</title>
    @vite('resources/js/app.js')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    {{-- <link rel="stylesheet" href="{{ asset('asset') }}/plugins/fontawesome-free/css/all.min.css"> --}}
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    @stack('css')
    <link rel="stylesheet" href="{{ asset('asset') }}/dist/css/adminlte.min.css">
    @stack('mycss')

</head>

<body class="layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-mini text-sm">
    <div class="wrapper">

        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img src="{{ asset('asset') }}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div> --}}

        @include('operator.layout.v_navbar')
        @include('operator.layout.v_main_sidebar_error')

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="col-sm-12">
                    </div>
                </div>
                @yield('content')
            </div>
            @include('operator.layout.v_footer')

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->



        <!-- Bootstrap 4 -->
        {{-- <script src="{{ asset('asset') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="{{ asset('asset') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('asset') }}/dist/js/adminlte.js"></script> --}}
        <!-- AdminLTE for demo purposes -->
        {{-- <script src="{{ asset('asset') }}/dist/js/demo.js"></script> --}}

        {{-- <script>
            /*** add active class and stay opened when selected ***/
            var url = window.location;

            // for sidebar menu entirely but not cover treeview
            $('ul.nav-sidebar a').filter(function() {
                if (this.href) {
                    return this.href == url || url.href.indexOf(this.href) == 0;
                }
            }).addClass('active');

            // for the treeview
            $('ul.nav-treeview a').filter(function() {
                if (this.href) {
                    return this.href == url || url.href.indexOf(this.href) == 0;
                }
            }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open');
            // }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
        </script> --}}

        <!-- jQuery -->
        <script src="{{ asset('asset') }}/plugins/jquery/jquery.min.js"></script>
        <script src="{{ asset('asset') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <script src="{{ asset('asset') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        {{-- <script src="{{ asset('asset') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> --}}
        <script src="{{ asset('asset') }}/dist/js/adminlte.js"></script>
        <script src="{{ asset('asset') }}/dist/js/demo.js"></script>
        @stack('java')

</body>

</html>
