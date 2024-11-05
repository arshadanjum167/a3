<?php $head_style=''; ?>
@if(Request::segment(1)=='blog' && Request::segment(2)!='')
<?php
$head_style="background:#33364a; !important;color:white;";
?>
@endif
<!-- ======= Header ======= -->
 <!-- <header id="header" class="fixed-top d-flex align-items-center  header-transparent "> -->
 <header id="header" class=" d-flex align-items-center  header-transparent " style="<?php echo $head_style?>">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        
        <a href="{{route('web_home')}}"><img src="{{ asset('assets/img/logo.png') }}" alt="{{config('params.appTitle')}}" class="img-fluid" style="display: inherit !important;"></a>
        <span style="
        vertical-align: top;
        display: inline-block;
        /* text-align: center; */
        margin: 16px auto;
    ">{{config('params.appTitle')}}
  <span style="display: block;font-size: 13px;">Free Online Tools & Converters</span></span>
      </div>

      

    </div>
  </header> 
  <!-- End Header -->