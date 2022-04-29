<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
	<meta name="keywords" content="Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- =============================================================================================== -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ... PWA Meta added -->
    <link rel="manifest" href="/manifest_seller.json" />
    <link rel="apple-touch-icon" href="img/apple-icon-152x152.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="white"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="dray">
    <meta name="apple-mobile-web-app-title" content="E-Shop Seller">
    <meta name="msapplication-TileImage" content="Seller">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <!-- ... PWA Link added -->       

    <title>{{ config('app.name', 'Seller Dashboard') }}</title>

    <!-- ... -->
    <link rel="manifest" href="{{ asset('manifest.json') }}" />
    <!-- ... -->

    <link href="{{ asset('assets/admin/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
        <!-- Fonts -->

  <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
      <!-- Google Font: Source Sans Pro -->
     <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
     <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script> -->
    <script>window.Laravel = {csrfToken: '{{ csrf_token() }}'}</script>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">

<div class="wrapper" id="seller">
  <!-- Navbar -->

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->


  <!-- Content Wrapper. Contains page content -->

       <seller-view></seller-view> 

  <!-- /.content-wrapper -->
<!-- //Content Wrapper. Contains page content -->

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->

  <!-- Main Footer -->


</div>
<!-- ./wrapper -->
<!--===============================================================================================-->
<!-- <script src="{{asset('assets/admin/js/popper.min.js')}}"></script> -->
        <!-- Scripts -->
        <script src="{{ asset('js/seller.js') }}" defer></script>
 <!--===============================================================================================-->
 <script src="{{ asset('assets/public/js/main.js') }}"></script>
<!-- REQUIRED SCRIPTS -->
<!-- <script src="{{asset('assets/admin/js/popper.min.js')}}"></script> -->
<!-- jQuery -->
<!-- <script src="{{asset('assets/admin/js/jquery.js')}}"></script> -->

<script src="{{asset('assets/admin/js/jquery.min.js')}}"></script> 

<!-- ChartJS -->
<script src="{{asset('assets/admin/js/Chart.min.js')}}"></script>

<!-- AdminLTE App -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('assets/admin/js/adminlte.min.js')}}"></script>
<script src="{{asset('assets/admin/js/dashboard.js')}}"></script>
<script src="{{asset('assets/admin/js/dashboard2.js')}}"></script>
<script src="{{asset('assets/admin/js/dashboard3.js')}}"></script>

 <!-- <script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>  -->

<!--===============================================================================================-->


</body>
</html>
