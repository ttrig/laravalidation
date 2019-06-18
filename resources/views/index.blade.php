<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  </head>
  <body>
    <script id="json-rows" type="text/template">{!! $json !!}</script>

    @include('_header')

    <div id="main-container" class="container">
      <laravalidation></laravalidation>
    </div>

    @include('_footer')

    <script src="{{ mix('js/app.js') }}"></script>
  </body>
</html>
