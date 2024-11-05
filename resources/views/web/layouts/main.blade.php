<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  $default_image=asset('assets/img/logo.png');
  $default_read_duration='20 minutes';
  if(isset($model->image) && $model->image!='')
  {
    $default_image=$model->image;
    $default_read_duration=$model->read_duration;
  }
  ?>
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
		<meta property="og:image" content="{{$default_image}}"/>

    <meta property="article:publisher" content="{{config('params.facebook_link')}}" />
    <meta property="article:modified_time" content="2022-06-23T14:06:47+00:00" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="@yield('title')" />
    <meta name="twitter:description" content="{{ $meta_description??'' }}" />
    <meta name="twitter:site" content="{{'@'.config('params.appTitle')}}" />
    <meta name="twitter:label1" content="Est. reading time" />
    <meta name="twitter:data1" content="{{$default_read_duration}}" />

  <title>@yield('title')</title>


  <!-- Tell the browser to be responsive to screen width -->
  @include('web.layouts.css')
  
<script src="{{asset('/assets/vendor/jquery/dist/jquery.min.js') }}"></script>
</head>
<body>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v10.0&appId=3896811027070383&autoLogAppEvents=1" nonce="VNGsogkK"></script>
      @include('web.layouts.top_header')
      <!-- include('web.layouts.floating_socialshare') -->
      @if( Request::segment(1) =='blog' && Request::segment(2) !='')
      <section id="hero" class="d-flex flex-column justify-content-end align-items-center">
        <div id="heroCarousel" data-bs-interval="5000" class="container carousel carousel-fade" data-bs-ride="carousel" style="height:250px;">

          <!-- Slide 1 -->
          <div class="carousel-item active">
            <div class="carousel-container" style="height:30vh;">
              <h1 class="animate__animated animate__fadeInDown">{{ $model->title}}</span></h1>
              
            </div>
          </div>
        </div>

        <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
          <defs>
            <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
          </defs>
          <g class="wave1">
            <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
          </g>
          <g class="wave2">
            <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
          </g>
          <g class="wave3">
            <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
          </g>
        </svg>

      </section><!-- End Hero -->
      @endif
      <main id="main">
      
      <section id="about" class="about">
      @if(0 && Request::segment(1) !='blog')
      <div class="row">
        <div class="col-sm-12" style="margin-bottom:12px;">
        
        </div>
      </div>
      @endif
        <div class="row">
      
      
        @include('web.layouts.sidebar')
        

        @yield('main_contant')

       
        @include('web.layouts.rightsidebar')
        </div>
        </section><!-- End About Section -->
      </main>
      

     
      </div>  
      
      </main>
        
      
        
          
      @include('web.layouts.footer')
      @include('web.layouts.scripts')
</body>

@yield('custom_scripts')
</html>
