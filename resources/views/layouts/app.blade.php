
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('page_title')</title>

  <!-- CSS only -->

  {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{asset('public/wa_assets/css/bootstrap.min.css')}}" >
  <link rel="stylesheet" href="{{asset('public/wa_assets/admin/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/wa_assets/admin/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/wa_assets/admin/css/adminlte.min.css')}}">
  
  <link rel="stylesheet" href="{{asset('public/wa_assets/css/style.css')}}">
  
  <!-- JS only -->
  {{-- <script src="{{asset('public/sdpl_assets/js/jquery-3.6.0.js')}}" ></script> --}}
  <script src="{{asset('public/wa_assets/js/jquery-3.6.0.min.js')}}" ></script>
  <script src="{{asset('public/wa_assets/js/popper.min.js')}}" ></script>
  <!-- JavaScript Bundle with Popper -->
  <script src="{{asset('public/wa_assets/js/bootstrap.bundle.min.js')}}" ></script>
  

  <script src="{{asset('public/wa_assets/admin/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <script src="{{asset('public/wa_assets/admin/js/adminlte.js')}}"></script>

  <script src="{{asset('public/wa_assets/admin/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
  <script src="{{asset('public/wa_assets/admin/raphael/raphael.min.js')}}"></script>
  <script src="{{asset('public/wa_assets/admin/jquery-mapael/jquery.mapael.min.js')}}"></script>
  <script src="{{asset('public/wa_assets/admin/jquery-mapael/maps/usa_states.min.js')}}"></script>
  <script src="{{asset('public/wa_assets/admin/chart.js/Chart.min.js')}}"></script>

  <script src="{{asset('public/wa_assets/js/head.js')}}" ></script>
  <script src="{{asset('public/wa_assets/js/master.js')}}" ></script>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-dark">
    @include('layouts.header')
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    @include('layouts.sidenav')
  </aside>

  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        @yield('style')
        @yield('content')
        @yield('script')
      </div>
    </section>

  </div>
  
  <aside class="control-sidebar control-sidebar-dark">
    @include('layouts.sidesetting')
    
  </aside>
  
  <footer class="main-footer">
    <strong>Copyright &copy; 2020-2021 <a href="https://digitalsteps.in" target="_blank">Digitalsteps.in</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>
</div>

</body>
</html>

