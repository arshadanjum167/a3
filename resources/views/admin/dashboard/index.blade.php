@php

$year=array();
$selected='';


@endphp

@extends('admin.layouts.main')
@section('title', 'Dashboard')
@section('main_contant')

<div class="content">
    @include('admin.dashboard._header')
    <section class="page-content container-fluid">
        @include('global.show_session')
      <div class="clearfix">
      <div class="row col-border-xl dashboard-deck">
      
			    <div class="col-3">
    				<div class="card-deck">
              <div class="card">  
                <a href="{{  route('admin.project.index') }}"> 
                  <div class="card-body">
                      <h2 class="card-title m-b-5 counter text-primary">{{ $count['total_projects']??0 }}</h2>
                      <h6 class="text-muted m-t-15 mb-0 lh-normal">
                              Total Number of Projects
                      </h6>
                  </div>
                </a>
              </div>
            </div>
          </div>
          

          <div class="col-3">
    				<div class="card-deck">
              <div class="card">  
                <a href="{{  route('admin.testimonial.index') }}"> 
                  <div class="card-body">
                      <h2 class="card-title m-b-5 counter text-primary">{{ $count['total_testimonials']??0 }}</h2>
                      <h6 class="text-muted m-t-15 mb-0 lh-normal">
                              Total Number of Testimonial
                      </h6>
                  </div>
                </a>
              </div>
            </div>
          </div>
          

          <div class="col-3">
    				<div class="card-deck">
              <div class="card">  
                <a href="{{  route('admin.case-study.index') }}"> 
                  <div class="card-body">
                      <h2 class="card-title m-b-5 counter text-primary">{{ $count['total_casestudy']??0 }}</h2>
                      <h6 class="text-muted m-t-15 mb-0 lh-normal">
                              Total Number of Case-study
                      </h6>
                  </div>
                </a>
              </div>
            </div>
          </div>
          

          

          

        </div>
        
    </div>
    
  </section>
</div>
@endsection

@section('custom_scripts')

<script>

</script>
    

    <script>
           


        </script>

        <script>
	    
	</script>

@endsection
