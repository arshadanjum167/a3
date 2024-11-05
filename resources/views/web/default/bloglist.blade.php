
@extends('web.layouts.main')
@section('title', $title.' - ' .config('params.appTitle')) 
@section('main_contant')
<!-- <link rel="stylesheet" href="{{ URL::asset('css/catch_mouse.css') }} "> -->
<div class="col-sm-10">
<!-- ======= About Section ======= -->

       <!-- ======= Team Section ======= -->
    <section id="team" class="team">
      <div class="container">

        <div class="section-title text-center" data-aos="">
          <!-- <h2>Top Blogs</h2> -->
          <p style="text-transform:none;">Top Blogs</p>
          <span class="blog_title">Good Blog - Best Ideas</span>
        </div>
        
        <div class="row">
        @foreach($data as $record)
          <div class="col-lg-6 col-md-6 d-flex align-items-stretch" style="width:335px">
            <div class="member" data-aos="fade-up">
              <a href="{{url('blog/'.$record->route_name)}}" >
              <div class="member-img">
                <img src="{{$record->image}}" class="img-fluid" alt="{{$record->title}}" style="height:210px;width:335px;">
                <!-- <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div> -->
              </div>
              <div class="member-info">
                <h4>{{$record->title}}</h4>
                <span>{{date('F d, Y', strtotime($record->i_date))}} | {{$record->read_duration}}
                  | <i class="bi bi-eye"> </i> {{$record->read_count}}
                </span>
              </div>
              </a>
            </div>
          </div>

          @endforeach
        </div>

      </div>
    </section><!-- End Team Section -->
        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {!! $data->links() !!}
        </div>
    </div>
  
<!-- </div> -->
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