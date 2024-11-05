<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicon.png')}}">

  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  @include('admin.layouts.css')
</head>

<body>
    <div id="app">
      @include('admin.layouts.sidebar')
      <div class="content-wrapper">
          @include('admin.layouts.top_header')
            @yield('main_contant')
      </div>
    </div>
</body>
@include('admin.layouts.scripts')
@yield('custom_scripts')
</html>
