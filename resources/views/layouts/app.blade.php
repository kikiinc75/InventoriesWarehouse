<!DOCTYPE html>
<!--
Item Name: Elisyam - Web App & Admin Dashboard Template
Version: 1.5
Author: SAEROX

** A license must be purchased in order to legally use this template for your project **
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title','')</title>
    <meta name="description" content="Elisyam is a Web App and Admin Dashboard Template built with Bootstrap 4">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Google Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
    <script>
      WebFont.load({
        google: {"families":["Montserrat:400,500,600,700","Noto+Sans:400,700"]},
        active: function() {
            sessionStorage.fonts = true;
        }
    });
</script>
<!-- Favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/img/new/favicon.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/img/new/favicon.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/img/new/favicon.png')}}">
<!-- Stylesheet -->
<link rel="stylesheet" href="{{asset('assets/vendors/css/base/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendors/css/base/elisyam-1.5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/owl-carousel/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/owl-carousel/owl.theme.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/datatables/datatables.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/bootstrap-select/bootstrap-select.min.css')}}">
<!-- personal css -->
<link rel="stylesheet" href="{{asset('css/special.css')}}">
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    </head>
    <body id="page-top">
        <div class="page">
            <!-- Begin Header -->
            <header class="header">
                <nav class="navbar fixed-top">
                    <!-- Begin Topbar -->
                    <div class="navbar-holder d-flex align-items-center align-middle justify-content-between">
                        <!-- Begin Logo -->
                        <div class="navbar-header">
                            <a href="/" class="navbar-brand">
                                <div class="brand-image brand-big">
                                    <img src="{{asset('assets/img/logo-big.png')}}" alt="logo" class="logo-big">
                                </div>
                                <div class="brand-image brand-small">
                                    <img src="{{asset('assets/img/logo.png')}}" alt="logo" class="logo-small">
                                </div>
                            </a>
                            <!-- Toggle Button -->
                            <a id="toggle-btn" href="#" class="menu-btn active">
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                            <!-- End Toggle -->
                        </div>
                        <!-- End Logo -->
                        <!-- Begin Navbar Menu -->
                        <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center pull-right">
                            <!-- User -->
                            <h4>Hello, {{Auth::user()->nama_user}}</h4>
                            <li class="nav-item dropdown"><a id="user" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><img src="{{asset('assets/img/avatar/avatar-01.jpg')}}" alt="..." class="avatar rounded-circle"></a>
                                <ul aria-labelledby="user" class="user-size dropdown-menu">
                                    <li class="welcome">
                                        <img src="{{asset('assets/img/avatar/avatar-01.jpg')}}" alt="..." class="rounded-circle">
                                    </li>
                                    <li>
                                        <div class="account">
                                            <p>{{Auth::user()->email}}</p>    
                                        </div>
                                    </li>
                                    <li class="separator"></li>
                                    <li>
                                        <div class="account">
                                            <p>
                                                @if(Auth::user()->id_level=='1')
                                                Admin
                                                @elseif(Auth::user()->id_level=='2')
                                                Operator
                                                @else
                                                Pegawai
                                                @endif
                                            </p>
                                        </div>
                                    </li>
                                    <li class="separator"></li>
                                    <li>
                                        <a rel="nofollow" class="dropdown-item logout text-center" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="ti-power-off"></i></a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                <!-- End User -->
                            </ul>
                            <!-- End Navbar Menu -->
                        </div>
                        <!-- End Topbar -->
                    </nav>
                </header>
                <!-- End Header -->
                <!-- Begin Page Content -->
                <div class="page-content d-flex align-items-stretch">
                    @section('sidebar')
                    @include('layouts.sidebar',['user' => Auth::User()])
                    @show
                    <!-- End Left Sidebar -->
                    <div class="content-inner">
                        <div class="container-fluid">
                            <div class="background">
                                <div class="row flex-row">
                                    <div class="col-xl-12">
                                        @yield('content')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Container -->
                        <!-- Begin Page Footer-->
                        <footer class="main-footer">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 d-flex align-items-center justify-content-xl-start justify-content-lg-start justify-content-md-start justify-content-center">
                                    <p class="text-gradient-02">Design By <a href="https://github.com/kikiinc75">Wahyu Iqbal</a></p>
                                </div>
                            </div>
                        </footer>
                        <!-- End Page Footer -->
                        <!-- End Content -->
                    </div>
                </div>
                <!-- End Page Content -->
            </div>
            <!-- Begin Vendor Js -->
            <script src="{{asset('assets/vendors/js/base/jquery.min.js')}}"></script>
            <script src="{{asset('assets/vendors/js/base/core.min.js')}}"></script>
            <!-- End Vendor Js -->
            <!-- Begin Page Vendor Js -->
            <script src="{{asset('assets/vendors/js/nicescroll/nicescroll.min.js')}}"></script>
            <script src="{{asset('assets/vendors/js/owl-carousel/owl.carousel.min.js')}}"></script>
            <script src="{{asset('assets/vendors/js/app/app.js')}}"></script>
            <script src="{{asset('assets/vendors/js/bootstrap-select/bootstrap-select.min.js')}}"></script>
            <script src="{{asset('assets/vendors/js/datatables/datatables.min.js')}}"></script>
            <script src="{{asset('assets/vendors/js/datatables/dataTables.buttons.min.js')}}"></script>
            <script src="{{asset('assets/vendors/js/datatables/jszip.min.js')}}"></script>
            <script src="{{asset('assets/vendors/js/datatables/buttons.html5.min.js')}}"></script>
            <script src="{{asset('assets/vendors/js/datatables/pdfmake.min.js')}}"></script>
            <script src="{{asset('assets/vendors/js/datatables/vfs_fonts.js')}}"></script>
            <script src="{{asset('assets/vendors/js/datatables/buttons.print.min.js')}}"></script>
            <script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}"></script>
            <!-- End Page Vendor Js -->
            <!-- Begin Page Snippets -->
            <script src="{{asset('assets/js/components/tables/tables.js')}}"></script>
            <!-- End Page Snippets -->
            @include('sweetalert::alert')
            @section('js')
            @show
        </body>
        </html>