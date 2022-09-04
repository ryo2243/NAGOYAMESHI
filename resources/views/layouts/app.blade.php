<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">    
    <link href="https://fonts.googleapis.com/css2?family=Carter+One&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="{{ asset('/css/nagoyameshi.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="wrapper">
        @include('layouts.header')

        <main class="py-4 content">
            @if (Auth::guard('admin')->check())
                <div class="container nagoyameshi-container">
                    <div class="row justify-content-center">
                        @include('layouts.sidebar')
                        @yield('content')
                    </div>
                </div>
            @else
                @yield('content')
            @endif
        </main>

        @include('layouts.footer')
    </div>

    @stack('scripts')
</body>
</html>
