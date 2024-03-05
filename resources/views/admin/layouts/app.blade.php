<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Warko | @yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('/warungdashboard') }}/assets/img/favicon.png" rel="icon">
    <link href="{{ asset('/warungdashboard') }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('/warungdashboard') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/warungdashboard') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('/warungdashboard') }}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('/warungdashboard') }}/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="{{ asset('/warungdashboard') }}/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="{{ asset('/warungdashboard') }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="{{ asset('/warungdashboard') }}/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('/warungdashboard') }}/assets/css/style.css" rel="stylesheet">

    <link href="{{ asset('v1/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
    @stack('before-style')
    <link href="{{ asset('v1/css/style.css') }}" rel="stylesheet">
    @stack('after-style')

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    @include('admin.layouts.navbar')
    @include('admin.layouts.sidebar')
    <main id="main" class="main">
        @yield('content')
    </main><!-- End #main -->
    @include('admin.layouts.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('/warungdashboard') }}/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('/warungdashboard') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/warungdashboard') }}/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="{{ asset('/warungdashboard') }}/assets/vendor/echarts/echarts.min.js"></script>
    <script src="{{ asset('/warungdashboard') }}/assets/vendor/quill/quill.min.js"></script>
    <script src="{{ asset('/warungdashboard') }}/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="{{ asset('/warungdashboard') }}/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="{{ asset('/warungdashboard') }}/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('/warungdashboard') }}/assets/js/main.js"></script>
    <script src="{{ asset('v1/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('v1/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
    @stack('before-scripts')
    <script src="{{ asset('v1/js/custom.min.js') }}"></script>
    <script src="{{ asset('v1/js/dlabnav-init.js') }}"></script>
    @stack('after-scripts')
    @stack('javascript')
</body>

</html>
