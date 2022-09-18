<!DOCTYPE html>
<html lang="en" class="default-style layout-fixed layout-navbar-fixed">
    <!-- Mirrored from html.phoenixcoded.net/empire/bootstrap/default/tables_bootstrap.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Jun 2020 10:58:42 GMT -->
    <head>
        <title> {{ config('app.name') }}  @yield('page_title')</title>
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
        <link rel="stylesheet" href="{{asset('backend/links/assets')}}/libs/flot/flot.css">

       {{--  <!--toster js-->
        <link rel="stylesheet" href="{{asset('backend/links/assets')}}/libs/toastr/toastr.css"> --}}

        <link rel="stylesheet" href="{{asset('custom_css/backend/for-all-file')}}/page-title-style.css">
        @stack('extra-css')
        @stack('custom-css')
        @stack('css')
    </head>
    <body>
        <div class="page-loader">
            <div class="bg-primary"></div>
        </div>

        <!---layout-wrapper layout-2-->
        <div class="layout-wrapper layout-2">
            <!---layout-inner-->
            <div class="layout-inner">
                
                <!---------layout-sidenav-------->
                <div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-white logo-dark">
                    <!---left-sidenav-->
                    @include('layouts.backend.partial.left_side_bar')
                    <!---left-sidenav-->
                    <div class="sidenav-divider mt-0"></div>
                </div><!---layout-sidenav-->
                <!---------layout-sidenav-------->

                <!---layout-container-->
                <div class="layout-container">
                    
                    <!---top header right side-->
                    @include('layouts.backend.partial.header')
                    <!---top header right side-->

                        <!---page_title_of_content-->
                        @stack('page_title_of_content')
                        <!---page_title_of_content-->

                    <!---layout-content-->
                    <div class="layout-content">
                        <!---layout-content-->

                        
                        <!---container-fluid flex-grow-1 container-p-y-->
                        <div class="container-fluid flex-grow-1 container-p-y">
                            <!---container-fluid flex-grow-1 container-p-y--> 

                                @yield('content')
                                
                            <!---container-fluid flex-grow-1 container-p-y-->    
                        </div><!---container-fluid flex-grow-1 container-p-y-->
                        <!---container-fluid flex-grow-1 container-p-y-->

                        <!---footer-->
                        @include('layouts.backend.partial.footer')
                        <!---footer-->

                    </div><!---layout-content-->
                    <!---layout-content-->

                </div><!---layout-container-->
                <!---layout-container-->

            </div><!---layout-inner-->
            <!---layout-inner-->

            <div class="layout-overlay layout-sidenav-toggle"></div>
        </div><!---layout-wrapper layout-2-->
        <!---layout-wrapper layout-2-->


        <!-- AJAX Js-->
        <script src="{{asset('backend/links/assets')}}/js/main.jquery-3.3.1.min.js"></script>

        <script src="{{asset('backend/links/assets')}}/js/pace.js"></script>
        {{-- <script src="{{asset('backend/links/assets')}}/js/jquery-3.3.1.min.js"></script> --}}
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

       {{--  <!--toster js-->
        <script src="{{asset('backend/links/assets')}}/libs/toastr/toastr.js"></script> --}}
            {{-- 
                <script>
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
                </script> 
            --}}

        <script src="{{asset('backend/links/assets')}}/js/pages/dashboards_index.js"></script>

           

        {{-- <!-- Custom Js-->
        <script src="{{asset('assets/admin/js/custom.js')}}"></script> --}}

        <!--notify js-->
        <script src="{{asset('backend/links/assets')}}/js/notify.js"></script>

        <!-- select 2-->
        <script src="{{asset('backend/links/assets')}}/js/select2.full.min.js"></script>
        <script>
            $('.select2').select2();
        </script>
        {{-- <script src="{{asset('backend/links/assets')}}/js/myscript.js"></script> --}}
        

        <!-- AJAX Js-->
        <script src="{{asset('backend/links')}}/assets/js/pages/ui_modals.js"></script>
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

    <!-- Mirrored from html.phoenixcoded.net/empire/bootstrap/default/tables_bootstrap.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Jun 2020 10:58:42 GMT -->
</html>
