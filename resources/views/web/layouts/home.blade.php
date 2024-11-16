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


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Teko:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('/assets/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{asset('/assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{asset('/assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('/assets/css/web/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('/assets/css/web/style.css') }}" rel="stylesheet">

    <!-- WhatsApp Button -->
    <a href="https://wa.me/+919099065941" class="whatsapp-button" target="_blank">
        <i class="fab fa-whatsapp" aria-hidden="true"></i>
    </a>
    <a href="tel:+919099065941" class="call-button">
        <i class="fa fa-phone"></i> <!-- Replace with your icon class if needed -->
    </a>

    <link rel="canonical" href="{{Request::fullUrl()}}" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:title" content="@yield('title')"/>
		<meta property="og:type" content="article"/>
		<meta property="og:url" content="{{Request::fullUrl()}}"/>
		<meta property="og:site_name" content="{{config('params.appTitle')}}"/>
		<meta property="og:description" content="{{ $meta_description??'' }}"/>
		<meta property="og:image" content="{{ asset('assets/img/logo.png') }}"/>

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
  
</head>
<body>

<!-- <div > -->
      @include('web.layouts.top_header')
  
      <!-- <main id="main">
      <section id="about" class="about">
      
        <div class="row"> -->
      
      
        
      

        @yield('main_contant')

        
        
        <!-- </div>
        </section> End About Section -->
         
      <!-- </main> -->
      @include('web.layouts.footer')
    <!-- </div> -->
      
      @include('web.layouts.scripts')
</body>

@yield('custom_scripts')
</html>
