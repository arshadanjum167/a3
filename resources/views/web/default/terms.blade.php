
@extends('web.layouts.main')
@section('title', $title.' - ' .config('params.appTitle')) 
@section('main_contant')

<!-- <link rel="stylesheet" href="{{ URL::asset('css/catch_mouse.css') }} "> -->
<div class="col-sm-7">
<!-- ======= About Section ======= -->

  <div class="container">
<!-- / -->
    {!!$data!!}
    @if(Request::segment(1)=='contactus')
    
      @endif
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