<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="theme-color" content="#ff2d20" />
    <meta name="msapplication-navbutton-color" content="#ff2d20">
    <meta name="apple-mobile-web-app-status-bar-style" content="#ff2d20">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  </head>
  <body>
    @include('_header')

    <div id="main-container" class="max-w-screen-xl mx-auto p-1 lg:p-0">
      <laravalidation json="{{ $json }}"></laravalidation>
    </div>

    @include('_footer')

    <script src="{{ mix('js/app.js') }}"></script>
  </body>
</html>
