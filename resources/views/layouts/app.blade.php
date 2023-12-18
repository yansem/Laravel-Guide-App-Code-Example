@props(['title'])
    <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icon/font/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicons/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('favicons/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
<div id="app"></div>
@if ($message = session()->get('success'))
    <div class="alert alert-success alert-dismissible fade show alert_show" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if ($message = session()->get('error'))
    <div class="alert alert-danger alert-dismissible fade show alert_show" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<nav class="header navbar navbar-expand-md navbar-light bg-white shadow-sm position-sticky w-100 top-0">
    <div class="container-fluid">
        @include('includes.main_menu')
        <button class="navbar-toggler" style="margin-left: auto; margin-right: 5px" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedSearch" aria-controls="navbarSupportedSearch" aria-expanded="false" aria-label="Поиск">
            <span class="navbar" style="margin: -2px 0 -3px 0">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </span>
        </button>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent, #navbarSupportedContentTwo"
                aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item menu_center">
                    <a class="nav-link {{ (in_array(Route::currentRouteName(), ['guide.show', 'chapter.show'])) ? 'active' : '' }} ps-2 d-flex cursor-pointer"
                       href="{{ route('home') }}">{{ __('Guides') }}</a>
                </li>
                @if ($userPermission > 1)
                    <li class="nav-item">
                        <a class="nav-link {{ Route::current()->getName() === 'guide.create' ? 'active' : '' }} ps-2 me-2 d-flex cursor-pointer align-items-center"
                           href="{{ route('guide.create') }}">{{ __('Add guide') }}</a>
                    </li>
                    {{--                        <li class="nav-item">--}}
                    {{--                            <a class="nav-link {{ Route::current()->getName() === 'page.logs' ? 'active' : '' }} ps-2 d-flex cursor-pointer align-items-center"--}}
                    {{--                               href="{{ route('page.logs') }}">История</a>--}}
                    {{--                        </li>--}}
                @endif
            </ul>
        </div>
        <div class="collapse header__search navbar-collapse justify-content-between align-center" id="navbarSupportedSearch"  style="flex: none">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <nav class="navbar navbar-light justify-content-between">
                        <form action="{{ route('page.search') }}" method="get" id="search" class="w-100 ms-auto form-inline d-inline-flex">
                            <div class="input-group  border">
                                <input minlength="2" class="form-control bg-none border-0 @error('q') is-invalid @enderror" autocomplete="off" name="q" type="search" value="{{ old('q') ?: request()->get('q') ?: '' }}" placeholder="{{ __('Search') }}" aria-label="{{ __('Search') }}" required>
                                <div class="input-group-append border-0">
                                    <button class="btn btn-link text-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </nav>
                    @error('q')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse justify-content-between align-center" id="navbarSupportedContentTwo" style="flex: none">
            <ul class="navbar-nav ml-auto mx-2">
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

<main class="container-fluid">
    @include('includes.sidebar', ['guides' => $guides])
    {{ $slot }}
</main>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery/jquery-3.6.0.min.js') }}"></script>
@stack('js')
</body>
</html>
