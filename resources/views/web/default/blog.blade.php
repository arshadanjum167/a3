
@extends('web.layouts.main')
@section('title', $title.' - ' .config('params.appTitle')) 
@section('main_contant')
<!-- <link rel="stylesheet" href="{{ URL::asset('css/catch_mouse.css') }} "> -->

<div class="col-sm-7">
<!-- ======= About Section ======= -->
  <div class="container">
  <div class="entry-meta">
    <span  class="blog-date">
      <!-- <strong>Published On:</strong>  -->
      <?php echo date('F d, Y', strtotime($model->i_date));?>
      |
      <?php echo $model->read_duration.' read';?>
      | <i class="bi bi-eye"> </i> {{$model->read_count}}
    </span>
    <!-- <span class="blog-date text-center">
    <i class="bx bxs-time"></i> <?php // echo $model->read_duration.' read';?>
    </span> -->
    <!-- <span class="blog-date text-right" >
    <strong>Last Updated:</strong> <?php //echo date('F d, Y', strtotime($model->u_date));?>
    </span> -->
  </div>
  <br>
  <div class="single-thumbnail">
  <img width="1440" height="500" src="<?php echo $model->image;?>" class="" alt="<?php echo $model->title?>" loading="lazy" sizes="(max-width: 1440px) 100vw, 1440px">                
  </div>
<!-- / -->
    {!!$model->content!!}
    <?php 
    if(isset($blogAuther) && $blogAuther!=null){
    ?>
    @include('web.default.author_detail')
    <?php 
    }
    ?>
  </div>
  
</div>
<!-- <div id="app"></div> -->

@endsection
@section('custom_scripts')
<!-- <script src="{{asset('/js/babeltojs.js')}}"></script> -->
<script>
document.querySelector("iframe").addEventListener("load", 
    function() {
        window.scrollTo({
    top: 0,
    left: 0,
    behavior: 'smooth'
  });
});

</script>
@endsection