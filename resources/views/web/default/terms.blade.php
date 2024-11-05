
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
    <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSdNXzjrVC-kCRdRTvOeaPCDHd7LfpkG8JGcWMIIZwnXl_CTdA/viewform?embedded=true" width="760" height="1000" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
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