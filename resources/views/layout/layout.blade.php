<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'To Do App')</title>
    <link href="{{ asset("assets/css/bootstrap.min.css") }}" rel="stylesheet" >
    <link href="{{ asset("assets/css/app.css") }}" rel="stylesheet" >
  </head>
  <body>
    @include('include.header')
    @yield('content')

    <script src="{{ asset("assets/js/bootstrap.min.js") }} "></script>
  </body>
</html>
