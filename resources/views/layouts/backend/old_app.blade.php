<!DOCTYPE html>
<html lang="en" class="default-style layout-fixed layout-navbar-fixed">

    {{-- <!-- Mirrored from html.phoenixcoded.net/empire/bootstrap/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Jun 2020 10:45:56 GMT --> --}}
    <head>
        <title> {{ config('app.name') }} @yield('page_title')</title>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="Empire is one of the unique admin template built on top of Bootstrap 4 framework. It is easy to customize, flexible code styles, well tested, modern & responsive are the topmost key factors of Empire Dashboard Template" />
        <meta name="keywords" content="bootstrap admin template, dashboard template, backend panel, bootstrap 4, backend template, dashboard template, saas admin, CRM dashboard, eCommerce dashboard">
        <meta name="author" content="Codedthemes" />
        <link rel="icon" type="image/x-icon" href="{{asset('backend/links/assets')}}/img/favicon.ico">

        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

        <link rel="stylesheet" href="{{asset('backend/links/assets')}}/fonts/fontawesome.css">
        <link rel="stylesheet" href="{{asset('backend/links/assets')}}/fonts/ionicons.css">
        <link rel="stylesheet" href="{{asset('backend/links/assets')}}/fonts/linearicons.css">
        <link rel="stylesheet" href="{{asset('backend/links/assets')}}/fonts/open-iconic.css">
        <link rel="stylesheet" href="{{asset('backend/links/assets')}}/fonts/pe-icon-7-stroke.css">
        <link rel="stylesheet" href="{{asset('backend/links/assets')}}/fonts/feather.css">

        <link rel="stylesheet" href="{{asset('backend/links/assets')}}/css/bootstrap-material.css">
        <link rel="stylesheet" href="{{asset('backend/links/assets')}}/css/shreerang-material.css">
        <link rel="stylesheet" href="{{asset('backend/links/assets')}}/css/uikit.css">

        <link rel="stylesheet" href="{{asset('backend/links/assets')}}/libs/perfect-scrollbar/perfect-scrollbar.css">
        <link rel="stylesheet" href="{{asset('backend/links/assets')}}/libs/flot/flot.css">
        @stack('extra-css')
        @stack('custom-css')
        @stack('css')
    </head>
    <body>

        <div class="page-loader">
            <div class="bg-primary"></div>
        </div>


        <div class="layout-wrapper layout-2">
            <div class="layout-inner">
                <!-----left side bar top section - with logo---->
                <!--layout-sidenav-->
                @include('layouts.backend.partial.left_side_bar')
                <!--layout-sidenav-->
                <!-----end left side bar top section - with logo---->

                <!----layout with top & left side bar and footer--->
                <div class="layout-container">

                    <!---Header section----->
                        <!--nav-->
                        @include('layouts.backend.partial.header')
                        <!--nav-->
                    <!---Header section----->
                    
                    <!---page title section----->
                    @yield('page_content_title')
                    <!---page title section----->
                    
                    <!----------page content/ blank page------------>
                    <div class="layout-content">

                            <!--container-fluid flex-grow-1 container-p-y-->
                            @yield('content')
                            <!--container-fluid flex-grow-1 container-p-y-->

                            <!-----Footer Nav------>
                            @include('layouts.backend.partial.footer')
                            <!-----Footer Nav------>
                    </div><!--layout-content--->
                    <!----------page content/ blank page------------>

                </div>
                <!----End layout with top & left side bar and footer--->

            </div><!---End layout-inner---->
            <div class="layout-overlay layout-sidenav-toggle"></div>
        </div><!--end -layout-wrapper layout-2--->

            <!-------------Modal------------>
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="modal-content">
                <div class="modal-body pb-1">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <div class="text-center">
                <h3 class="mt-3">Welcome To <span class="text-primary">Empire</span><sup>v1.0.1</sup></h3>
                </div>
                <div class="carousel-inner">
                <div class="carousel-item active" data-interval="50000">
                <div class="row align-items-center">
                <div class="col-md-6 text-center">
                <img src="{{asset('backend/links/assets')}}/img/pages/welcome.png" class="img-fluid my-4" alt="images">
                </div>
                <div class="col-md-6">
                <p class="f-16"><strong>Empire Admin v1.0.1</strong> will come with new prebuild mini admins.</p>
                <p class="f-16"> it include <strong>8+ New Admin Panels</strong> like</p>
                <p class="mb-2 f-16"><i class="feather icon-check-circle mr-2 text-primary"></i>Hospital</p>
                <p class="mb-2 f-16"><i class="feather icon-check-circle mr-2 text-primary"></i>Project & CRM</p>
                <p class="mb-2 f-16"><i class="feather icon-check-circle mr-2 text-primary"></i>Membership</p>
                <p class="mb-2 f-16"><i class="feather icon-check-circle mr-2 text-primary"></i>Helpdesk</p>
                <p class="mb-2 f-16"><i class="feather icon-check-circle mr-2 text-primary"></i>School</p>
                <p class="mb-2 f-16"><i class="feather icon-check-circle mr-2 text-primary"></i>SIS</p>
                <p class="mb-2 f-16"><i class="feather icon-check-circle mr-2 text-primary"></i>Crypto</p>
                <p class="mb-2 f-16"><i class="feather icon-check-circle mr-2 text-primary"></i>E-Commerce</p>
                </div>
                </div>
                <div class="row justify-content-center">
                <div class="col-lg-9">
                </div>
                </div>
                </div>
                <div class="carousel-item" data-interval="50000">
                <img src="{{asset('backend/links/assets')}}/img/pages/admin.png" class="img-fluid mt-0" alt="images">
                </div>
                </div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" style="transform:rotate(180deg);margin-bottom:-1px">
                <path class="elementor-shape-fill" fill="#2c3134" opacity="0.33" d="M473,67.3c-203.9,88.3-263.1-34-320.3,0C66,119.1,0,59.7,0,59.7V0h1000v59.7 c0,0-62.1,26.1-94.9,29.3c-32.8,3.3-62.8-12.3-75.8-22.1C806,49.6,745.3,8.7,694.9,4.7S492.4,59,473,67.3z">
                </path>
                <path class="elementor-shape-fill" fill="#2c3134" opacity="0.66" d="M734,67.3c-45.5,0-77.2-23.2-129.1-39.1c-28.6-8.7-150.3-10.1-254,39.1 s-91.7-34.4-149.2,0C115.7,118.3,0,39.8,0,39.8V0h1000v36.5c0,0-28.2-18.5-92.1-18.5C810.2,18.1,775.7,67.3,734,67.3z"></path>
                <path class="elementor-shape-fill" fill="#2c3134" d="M766.1,28.9c-200-57.5-266,65.5-395.1,19.5C242,1.8,242,5.4,184.8,20.6C128,35.8,132.3,44.9,89.9,52.5C28.6,63.7,0,0,0,0 h1000c0,0-9.9,40.9-83.6,48.1S829.6,47,766.1,28.9z">
                </path>
                </svg>
                <div class="modal-body text-center py-4" style="background:#2c3134">
                <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>

                </ol>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="ml-2">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="mr-2">Next</span>
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </a>
                </div>
                </div>
                </div>
                </div>
            </div>
            <!-------------Modal------------>

        <script src="{{asset('backend/links/assets')}}/js/pace.js"></script>
        <script src="{{asset('backend/links/assets')}}/js/jquery-3.3.1.min.js"></script>
        <script src="{{asset('backend/links/assets')}}/libs/popper/popper.js"></script>
        <script src="{{asset('backend/links/assets')}}/js/bootstrap.js"></script>
        <script src="{{asset('backend/links/assets')}}/js/sidenav.js"></script>
        <script src="{{asset('backend/links/assets')}}/js/layout-helpers.js"></script>
        <script src="{{asset('backend/links/assets')}}/js/material-ripple.js"></script>

        <script src="{{asset('backend/links/assets')}}/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="{{asset('backend/links/assets')}}/libs/eve/eve.js"></script>
        <script src="{{asset('backend/links/assets')}}/libs/flot/flot.js"></script>
        <script src="{{asset('backend/links/assets')}}/libs/flot/curvedLines.js"></script>
        <script src="{{asset('backend/links/assets')}}/libs/chart-am4/core.js"></script>
        <script src="{{asset('backend/links/assets')}}/libs/chart-am4/charts.js"></script>
        <script src="{{asset('backend/links/assets')}}/libs/chart-am4/animated.js"></script>

        <script src="{{asset('backend/links/assets')}}/js/demo.js"></script>
        <script src="{{asset('backend/links/assets')}}/js/analytics.js"></script>
            {{-- <script>
                $(document).ready(function() {
                    // checkCookie();
                    $('#exampleModalCenter').modal();
                });

                function setCookie(cname, cvalue, exdays) {
                    var d = new Date();
                    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                    var expires = "expires=" + d.toGMTString();
                    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
                }

                function getCookie(cname) {
                    var name = cname + "=";
                    var decodedCookie = decodeURIComponent(document.cookie);
                    var ca = decodedCookie.split(';');
                    for (var i = 0; i < ca.length; i++) {
                        var c = ca[i];
                        while (c.charAt(0) == ' ') {
                            c = c.substring(1);
                        }
                        if (c.indexOf(name) == 0) {
                            return c.substring(name.length, c.length);
                        }
                    }
                    return "";
                }

                function checkCookie() {
                    var ticks = getCookie("modelopen");
                    if (ticks != "") {
                        ticks++;
                        setCookie("modelopen", ticks, 1);
                        if (ticks == "2" || ticks == "1" || ticks == "0") {
                            $('#exampleModalCenter').modal();
                        }
                    } else {
                        // user = prompt("Please enter your name:", "");
                        $('#exampleModalCenter').modal();
                        ticks = 1;
                        setCookie("modelopen", ticks, 1);
                    }
                }
            </script> --}}

        <script src="{{asset('backend/links/assets')}}/js/pages/dashboards_index.js"></script>


        {{-- <!-- Custom Js-->
        <script src="{{asset('assets/admin/js/custom.js')}}"></script> --}}

        <!-- select 2-->
        <script src="{{asset('backend/links/assets')}}/js/select2.full.min.js"></script>
        <script>
            $('.select2').select2();
        </script>
        <!-- AJAX Js-->
        <script src="{{asset('backend/links/assets')}}/js/myscript.js"></script>
        <script>
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        </script>

        @stack('extra-js')
        @stack('custom-js')
        @stack('js')

    </body>
    <!-- Mirrored from html.phoenixcoded.net/empire/bootstrap/default/index.html by HTTrack Website Copier/3.x [XR&CO2014], Sun, 21 Jun 2020 10:47:10 GMT -->
</html>







{{-- -
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>--}}


{{-- 
<style>
    .breadcrumbs.layout-navbar-fixed {
        position: fixed;
        background: #f0f4f5;
        border-bottom: 1px solid #e3e7e9;
        top: 70px;
        padding-left: 20px;
        padding-right: 300px;
        width: 100%;
    }
    .products {
        float: right;
        margin-top: -60px;
    }
</style>
<!---page_title_of_content-->
<!--
    <div class="breadcrumbs layout-navbar-fixed">
        <h4 class="font-weight-bold py-3 mb-0">fdgs sf </h4>
        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#"><i class="feather icon-home"></i></a>
                </li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Bootstrap</li>
            </ol>
        </div>
        <div class="products">
            <a href="#">Add Product</a>
        </div>
    </div> 
--> --}}