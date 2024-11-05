<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" />

  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  @include('admin.layouts.css')
</head>

<body>
      @yield('main_contant')
</body>
@include('admin.layouts.scripts')
@yield('custom_scripts')
</html>
