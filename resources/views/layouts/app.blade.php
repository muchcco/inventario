<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
     <!--begin::Fonts -->
     <link rel="stylesheet" href="{{ asset('assets/fonts.googleapis.com/css_ee6ab223.css')}}" />         <!--end::Fonts -->




     <!--begin::Global Theme Styles(used by all pages) -->
         <link href="{{ asset('assets/css/pages/login/login-3.css')}}" rel="stylesheet" type="text/css" />
         <link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
         <link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
     <!--end::Global Theme Styles -->

     <!--begin::Layout Skins(used by all pages) -->
     <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
     <link href="{{ asset('assets/css/skins/header/base/light.css')}}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('assets/css/skins/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('assets/css/skins/brand/dark.css')}}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('assets/css/skins/aside/dark.css')}}" rel="stylesheet" type="text/css" />
     <!--end::Layout Skins -->
     <!--Begin::style-->
             <!--End::style-->
             <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico')}}" />
             <style>
                .paginate_button {
                    margin-left: .4rem !important;
                }
                .last,.first {
                    background: #ebe9f2;

                }
                .paginate_button.current{
                    background: #5d78ff;
                    color: #fff;
                }
                .paginate_button.disabled{
                    opacity: .6;
                }

                div.dataTables_pager>.dataTables_paginate *,.dataTables_paginate,.dataTables_pager  {
                    display: flex !important;
                }

                .paginate_button:hover{
                    background: #5d78ff;
                    color: #fff;
                }

                .dataTables_pager,.dataTables_paginate {
                    justify-content: space-between;
                }
                .paginate_button {
                    color: #595d6e;
                    border-radius: 3px;
                    cursor: pointer;
                    display: -webkit-box;
                    display: -ms-flexbox;
                    display: flex;
                    -webkit-box-pack: center;
                    -ms-flex-pack: center;
                    justify-content: center;
                    -webkit-box-align: center;
                    -ms-flex-align: center;
                    align-items: center;
                    height: 2.25rem;
                    min-width: 2.25rem;
                    vertical-align: middle;
                    padding: .5rem;
                    text-align: center;
                    position: relative;
                    font-size: 1rem;
                    line-height: 1rem;
                    font-weight: 400;
                    display: flex;
                }
                </style>
             <!-- Hotjar Tracking Code for keenthemes.com -->

            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async="" src="{{ asset('assets/www.googletagmanager.com/gtag/js_d0953377.js')}}"></script>
</head>
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
    <div class="kt-grid kt-grid--ver kt-grid--root" id="app">
		<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url({{ asset('assets/media/bg/bg-3.jpg')}};">
				<div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
					<div class="kt-login__container">
						<div class="kt-login__logo">
							<a href="#">
								<img style="    width: 190px;" src="{{ asset('assets/media/logos/logo_inia.png')}}" />
							</a>
						</div>
        <!--<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar ->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar ->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links ->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
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
        </nav>-->

        <main class="py-4">
            @yield('content')
        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
         <!-- begin::Global Config(global config for global JS sciprts) -->
         <script>
            var KTAppOptions = {
    "colors": {
        "state": {
            "brand": "#5d78ff",
            "dark": "#282a3c",
            "light": "#ffffff",
            "primary": "#5867dd",
            "success": "#34bfa3",
            "info": "#36a3f7",
            "warning": "#ffb822",
            "danger": "#fd3995"
        },
        "base": {
            "label": [
                "#c5cbe3",
                "#a1a8c3",
                "#3d4465",
                "#3e4466"
            ],
            "shape": [
                "#f0f3ff",
                "#d9dffa",
                "#afb4d4",
                "#646c9a"
            ]
        }
    }
};
        </script>
         <!-- end::Global Config -->

    	 <!--begin::Global Theme Bundle(used by all pages) -->
    	    	    <script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}" type="text/javascript"></script>
		    	    <script src="{{ asset('assets/js/scripts.bundle.js')}}" type="text/javascript"></script>
				 <!--end::Global Theme Bundle -->


                     <!--begin::Page Scripts(used by this page) -->
                             <script src="{{ asset('assets/js/pages/custom/login/login-general.js')}}" type="text/javascript"></script>
                         <!--end::Page Scripts -->
             </body>
     <!-- end::Body -->
</html>
