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

    @vite(['resources/js/app.js'])
  </head>
  <body>
    @include('_header')

    <template id="initial-rows">{{ $json }}</template>

    <div class="max-w-screen-xl mx-auto p-1 lg:p-0">
      <div id="app">
        <laravalidation></laravalidation>
      </div>
      <div id="url-container" class="m-auto md:w-2/3 mb-4"></div>
    </div>

    @include('_footer')
  </body>
</html>
