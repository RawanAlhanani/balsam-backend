<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>جمعية بلسم لذوي التوحد  |  Association BALSAM Pour Autistes</title>

<link rel="shortcut icon" type="image/x-icon" href="{{asset('/backend/app-assets/images/logo/logo.png')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/backend/app-assets/fonts/line-awesome/css/line-awesome.min.css')}}">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('/backend/app-assets/css-rtl/vendors.css')}}">
  <!-- END VENDOR CSS-->
  @yield('links')
  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('/backend/app-assets/css-rtl/app.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/backend/app-assets/css-rtl/custom-rtl.css')}}">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('/backend/app-assets/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/backend/app-assets/css-rtl/core/colors/palette-gradient.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/backend/app-assets/fonts/simple-line-icons/style.css')}}">

  <!-- END Page Level CSS-->

  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('/backend/assets/css/style-rtl.css')}}">
  <!-- END Custom CSS-->
</head>
<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar"
   data-open="click" data-menu="vertical-menu" data-col="2-columns">
  <!-- fixed-top-->

  <!-- top navigation -->
  @include('admin.vendor.header')
  <!-- /top navigation -->

  <!-- ////////////////////////////////////////////////////////////////////////////-->

  <!-- top siderbar -->
  @include('admin.vendor.sidebar')
  <!-- /top siderbar -->

  <!-- page content -->
  @yield('content')
  <!-- /page content -->

  <!-- ////////////////////////////////////////////////////////////////////////////-->

  <!-- footer content -->
  @include('admin.vendor.footer')
  <!-- /footer content -->

  <!-- BEGIN VENDOR JS-->
  <script src="{{asset('/backend/app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->

  @yield('scripts')

  <!-- BEGIN PAGE VENDOR JS-->

  <script src="{{asset('/backend/app-assets/vendors/js/charts/raphael-min.js')}}" type="text/javascript"></script>
  <script src="{{asset('/backend/app-assets/vendors/js/charts/morris.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('/backend/app-assets/vendors/js/timeline/horizontal-timeline.js')}}" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->

  <!-- BEGIN MODERN JS-->
  <script src="{{asset('/backend/app-assets/js/core/app-menu.js')}}" type="text/javascript"></script>
  <script src="{{asset('/backend/app-assets/js/core/app.js')}}" type="text/javascript"></script>

  <!-- END MODERN JS-->



</body>
</html>
