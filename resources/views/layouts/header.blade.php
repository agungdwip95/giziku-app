<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Giziku | Dashboard</title>

  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" 
  integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  {{-- <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css"> --}}
  <link href="{{asset('plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
  <!-- Custom styles for this page -->
  <link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <!-- Untuk sweet alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- jQuery -->
  <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
  
  <!-- Leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicons/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicons/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicons/favicon-16x16.png') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicons/favicon.ico') }}">
  <link rel="manifest" href="{{ asset('assets/img/favicons/manifest.json') }}">
  <meta name="msapplication-TileImage" content="{{ asset('assets/img/favicons/mstile-150x150.png') }}">
  <meta name="theme-color" content="#ffffff">

  <!-- Stylesheets -->
  <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet" />

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    @media (max-width: 768px) {
    .main-sidebar {
        display: block !important;
    }
}

    @media only screen and (min-width: 992px) {
    .navbar {
      flex-direction: column;
    }

    .text {
      color: white;
      font-size: 20px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      white-space: nowrap;
    }

    @charset "UTF-8";

    .svg-inline--fa {
      vertical-align: -0.200em;
    }

    .rounded-social-buttons {
      text-align: center;
    }

    .rounded-social-buttons .social-button {
      display: inline-block;
      position: relative;
      cursor: pointer;
      width: 3.125rem;
      height: 3.125rem;
      border: 0.125rem solid transparent;
      padding: 0;
      text-decoration: none;
      text-align: center;
      color: #fefefe;
      font-size: 1.5625rem;
      font-weight: normal;
      line-height: 2em;
      border-radius: 1.6875rem;
      transition: all 0.5s ease;
      margin-right: 0.25rem;
      margin-bottom: 0.25rem;
    }

    .rounded-social-buttons .social-button:hover, .rounded-social-buttons .social-button:focus {
      -webkit-transform: rotate(360deg);
          -ms-transform: rotate(360deg);
              transform: rotate(360deg);
    }

    .rounded-social-buttons .fa-envelope, .fa-phone, .fa-instagram {
      font-size: 25px;
    }

    .rounded-social-buttons .social-button.gmail {
      background: #bb0000;
    }

    .rounded-social-buttons .social-button.gmail:hover, .rounded-social-buttons .social-button.gmail:focus {
      color: #bb0000;
      background: #fefefe;
      border-color: #bb0000;
    }

    .rounded-social-buttons .social-button.phone {
      background: #09d50f;
    }

    .rounded-social-buttons .social-button.phone:hover, .rounded-social-buttons .social-button.phone:focus {
      color: #09d50f;
      background: #fefefe;
      border-color: ##09d50f;
    }

    .rounded-social-buttons .social-button.instagram {
      background: #125688;
    }

    .rounded-social-buttons .social-button.instagram:hover, .rounded-social-buttons .social-button.instagram:focus {
      color: #125688;
      background: #fefefe;
      border-color: #125688;
    }

    .image_with_badge_container {
      display: inline-block; /* keeps the img with the badge if the img is forced to a new line */
      position: relative;
      margin-bottom: 5px;
    }

    .badge-on-image {
        position: absolute;
        bottom: 2px; /* position where you want it */
        left: 2px;
        padding: 3px 6px;
    }

    .main-sidebar {
      background: linear-gradient(180deg, #fef6ed, #fddbb2);
      color: white;
    }

    .content-wrapper{
      /* background-image: url('https://png.pngtree.com/background/20220718/original/pngtree-commercial-product-background-free-to-use-picture-image_1660883.jpg');  */
      background-image: url('{{ asset('img/main_bg2.jpg') }}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }
  }

  </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<main class="main" id="top">

@guest

  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-5 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
      <div class="container">
         <a class="navbar-brand" href="/dashboard">
            <img src="{{ asset('img/logo.png') }}" style="height: 100px; width: 100px;" alt="logo" />
        </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base align-items-lg-center align-items-center">
                  <!-- <li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" aria-current="page" href="/login">Login</a></li> -->
                  <li class="nav-item px-3 px-xl-4"><a class="btn btn-outline-dark order-1 order-lg-0 fw-medium" href="/login">Login</a></li>
                  <!-- <li class="nav-item dropdown px-3 px-lg-0">
                      <a class="d-inline-block ps-0 py-2 pe-3 text-decoration-none dropdown-toggle fw-medium" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">EN</a>
                      <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" style="border-radius:0.3rem;" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="#!">EN</a></li>
                          <li><a class="dropdown-item" href="#!">BN</a></li>
                      </ul>
                  </li> -->
              </ul>
          </div>
      </div>
  </nav>
@endguest

@can('isAdmin')

  <style>
    .main-header{
      display: block;
    }
    .mobile-header{
      display: none;
    }

    @media (max-width: 767.98px) {
      .main-header{
        display: none;
      }
      .mobile-header{
        display: block;
      }
      .itu{
        margin-left: 240px;
      }
    }
  </style>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Right navbar links -->
    <ul class="navbar-nav" style="margin-left: 1050px;">
      <!-- <li class="nav-item" style="margin-right: 1150px;"> -->
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
       <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nama }} | {{ Auth::user()->role }}</span>
            <img class="img-profile rounded-circle"
                src="{{asset('img/user.png')}}"/>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                <span>Keluar</span>
            </a></li>
          </ul>
        </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <nav class="mobile-header navbar navbar-expand navbar-white navbar-light">
    <!-- Right navbar links -->
    <ul class="navbar-nav ms-auto">
      <!-- <li class="nav-item" style="margin-right: 1150px;"> -->
       <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img class="img-profile rounded-circle"
                src="{{asset('img/user.png')}}"/>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                Keluar
            </a></li>
          </ul>
        </li>
        <li class="nav-item itu">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>

  @endcan 