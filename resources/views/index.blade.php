<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- =============================================================================================== -->

    <!-- CSRF Token -->
    <meta name="csrfToken" content="{{ csrf_token() }}">

	<!-- ... PWA Meta added -->
	<link rel="manifest" href="/manifest.json" />
	<link rel="apple-touch-icon" href="img/apple-icon-152x152.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="theme-color" content="white"/>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-title" content="E-Shop">
	<meta name="msapplication-TileImage" content="images/android-icon-144x144.png">
	<meta name="msapplication-TileColor" content="#FFFFFF">
	<!-- ... PWA Link added -->

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
	

    <!-- ... -->

<!--===============================================================================================-->  
<!--//tags -->
<link href="{{asset('assets/public/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/public/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/public/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('assets/public/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('assets/public/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('assets/public/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('assets/public/css/sweetalert2.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/public/css/sweetalert2.css')}}" rel="stylesheet">

	<link href="{{asset('assets/public/css/passtrength.css')}}" rel="stylesheet">

	<link href="{{asset('assets/public/css/main.css')}}" rel="stylesheet">
<!--===============================================================================================-->

    <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet" type="text/css"> -->

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
	<script>window.Laravel = {csrfToken: '{{ csrf_token() }}'}</script>
</head>
<body>
    <!-- Site wrapper start -->
    <div id="app">
<!--===================================     **  // HEADER START ** ============================================================-->		
  


  <!--===================================     **  // HEADER End ** ============================================================-->

		 <public-view></public-view>
		 
         <!-- set progressbar -->
         <!-- <vue-progress-bar></vue-progress-bar> -->
           <!--================================= **  // APP End ** ==================================================-->
     <!--Footer--> 

    <!--/Footer-->
     <!--===============================================================================================-->       
    </div>
	<!-- //App div end -->
	
<!--===============================================================================================-->
	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('assets/public/js/main.js') }}"></script>
<script src="{{ asset('assets/public/js/jquery.js') }}"></script>
	 <!-- <script type="text/javascript" src="{{ asset('assets/public/js/jquery-2.1.4.min.js') }}"></script>  -->
	<script src="{{ asset('assets/public/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/public/js/easy-responsive-tabs.js') }}"></script>	
    <script>
		$(document).ready(function () {
		$('#horizontalTab').easyResponsiveTabs({
		type: 'default', //Types: default, vertical, accordion           
		width: 'auto', //auto or any width like 600px
		fit: true,   // 100% fit in a container
		closed: 'accordion', // Start closed if in accordion view
		activate: function(event) { // Callback function if tab is switched
		var $tab = $(this);
		var $info = $('#tabInfo');
		var $name = $('span', $info);
		$name.text($tab.text());
		$info.show();
		}
		});
		$('#verticalTab').easyResponsiveTabs({
		type: 'vertical',
		width: 'auto',
		fit: true
		});
		});
    </script> 
	<script src="{{ asset('assets/public/js/jquery.scrollUp.min.js') }}"></script>
	<script src="{{ asset('assets/public/js/price-range.js') }}"></script>
    <script src="{{ asset('assets/public/js/jquery.prettyPhoto.js') }}"></script>

	<!-- single -->
        <script src="{{ asset('assets/public/js/imagezoom.js') }}"></script>
		<script src="{{ asset('assets/public/js/passtrength.js') }}"></script>

    <!-- //single -->
<!--===============================================================================================-->
     <!-- for bootstrap working -->
    <script src="{{ asset('assets/public/js/sweetalert2.all.min.js') }}"></script>    
</body>
</html>
