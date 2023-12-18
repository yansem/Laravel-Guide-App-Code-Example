<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icon/font/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jstree/default/style.min.css') }}" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicons/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('favicons/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
<nav class="header navbar navbar-expand-md navbar-light bg-white shadow-sm position-sticky w-100 top-0">
    <div class="container-fluid">
        @include('includes.main_menu')
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent, #navbarSupportedContentTwo"
                aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between align-center" id="navbarSupportedContentTwo" style="flex-grow: 0">
            <ul class="navbar-nav mx-1 ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        @if (isset(\Spo::user()->surname))
                            {{ \Spo::user()->surname }} {{ Helper::firstSymbol(\Spo::user()->name) }}
                            . {{ Helper::firstSymbol(\Spo::user()->patronymic) }}.
                        @endif
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                        <a class="dropdown-item" href="{{ request()->change_password }}">
                            {{ __('Change Password') }}
                        </a>
                        <a class="dropdown-item" href="{{ request()->logout  }}">
                            {{ __('Logout') }}
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" style="border: none">
                    <div class="card-body">
                        <div class="errorPage">
                            <div class="errorPage__topBlock">
                                <div class="errorPage__image"></div>
                                <div class="errorPage__title">@yield('message')</div>
                                <div class="errorPage__subtitle">{{ __('app.Error') }} @yield('code')</div>
                                <a href="{{ route('home') }}" class="btn btn-primary errorPage__btnMain">{{ __('app.Home') }}</a>
                            </div>
                            <div class="errorPage__bottom-block">
                                <div class="errorPage__message">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery/jquery-3.6.0.min.js') }}"></script>
</body>
</html>
