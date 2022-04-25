<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Aster | {{ $activePage }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    {{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css"> --}}
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet"
        href="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/toastr/toastr.min.css">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-3.1.0') }}/dist/css/adminlte.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet"
        href="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    {{-- jquery ui --}}
    <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-3.1.0/plugins/jquery-ui/jquery-ui.theme.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/daterangepicker/daterangepicker.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('disk/logo_posyandu.png') }}" alt="PosyanduLogo" height="60"
                width="60">
        </div>

        <!-- Navbar -->
        @include('layouts.header')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-white">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        @include('layouts.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/jquery/jquery.min.js"></script>
    {{-- <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script> --}}
    <!-- Bootstrap 4 -->
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/dist/js/adminlte.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/toastr/toastr.min.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/select2/js/select2.full.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js">
    </script>
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
    </script>
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    {{-- jquery ui --}}
    <script src="{{ asset('vendor/AdminLTE-3.1.0/plugins/jquery-ui/jquery-ui.js') }}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- ChartJS -->
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/chart.js/Chart.min.js"></script>
    {{-- Highchart --}}
    <script src="{{ asset('vendor/AdminLTE-3.1.0/plugins/highchart/highcharts.js') }}"></script>
    {{-- daterange --}}
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/daterangepicker/daterangepicker.js"></script>
    {{-- push js form yield content --}}
    @stack('js')
</body>

</html>
