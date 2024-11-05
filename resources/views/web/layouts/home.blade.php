<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" />
    <meta content="{{ $meta_description??'' }}" name="description">
    <meta content="{{ $meta_keyword??'' }}" name="keywords">
    <meta name="msvalidate.01" content="AE47B1AC151CA48DA1C80131F36CDF38" />
    <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large">

    <link rel="canonical" href="{{Request::fullUrl()}}" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:title" content="@yield('title')"/>
		<meta property="og:type" content="article"/>
		<meta property="og:url" content="{{Request::fullUrl()}}"/>
		<meta property="og:site_name" content="{{config('params.appTitle')}}"/>
		<meta property="og:description" content="{{ $meta_description??'' }}"/>
		<meta property="og:image" content="http://localhost:8001/assets/img/logo.png"/>

    <meta property="article:publisher" content="{{config('params.facebook_link')}}" />
    <meta property="article:modified_time" content="2022-06-23T14:06:47+00:00" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="@yield('title')" />
    <meta name="twitter:description" content="{{ $meta_description??'' }}" />
    <meta name="twitter:site" content="{{'@'.config('params.appTitle')}}" />
    <meta name="twitter:label1" content="Est. reading time" />
    <meta name="twitter:data1" content="20 minutes" />

  <title>@yield('title')</title>


  <!-- Tell the browser to be responsive to screen width -->
  @include('web.layouts.css')
  
<script src="{{asset('/assets/vendor/jquery/dist/jquery.min.js') }}"></script>
</head>
<body>
<div id="fb-root"></div>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v10.0&appId=3896811027070383&autoLogAppEvents=1" nonce="VNGsogkK"></script>
<div >
      @include('web.layouts.top_header')
      <!-- include('web.layouts.floating_socialshare') -->
  
      <main id="main">
      <section id="about" class="about">
      
        <div class="row">
      
      
        
      

        @yield('main_contant')

        
        
        </div>
        </section><!-- End About Section -->
         
      </main>
      @include('web.layouts.footer')
    </div>
      
      @include('web.layouts.scripts')
</body>

@yield('custom_scripts')
</html>
