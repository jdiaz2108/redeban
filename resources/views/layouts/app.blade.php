<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Redeban') }}</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/appnew.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('partials.header')
        <!-- Content -->
        @yield('content')

        @include('partials.footer')

        @auth
          @role('user')
            @include('partials.contact')
          @endrole

          <!-- SIDEMENU  -->
          @include('partials.custom-sidemenu')
          <!-- END SIDEMENU  -->
        @endauth
    </div>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-149265994-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', "UA-149265994-1");
    </script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    @yield('scripts')
</html>
