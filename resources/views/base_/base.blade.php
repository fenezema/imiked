<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>@yield('title')</title>

  @yield('head')
  <link href="template2/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="template2/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="template2/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="template2/css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  @include('base_.nav')
  <div class="content-wrapper">
    @yield('content')
    
    @include('base_.footer')
    <script src="template2/vendor/jquery/jquery.min.js"></script>
    <script src="template2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="template2/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="template2/vendor/chart.js/Chart.min.js"></script>
    <script src="template2/vendor/datatables/jquery.dataTables.js"></script>
    <script src="template2/vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="template2/js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="template2/js/sb-admin-datatables.min.js"></script>
    <script src="template2/js/sb-admin-charts.min.js"></script>
    <script src="https://maps.google.com/maps/api/js?sensor=true"></script>
    @yield('script')
  </div>
</body>

</html>
