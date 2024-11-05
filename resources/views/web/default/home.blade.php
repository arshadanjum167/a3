@extends('web.layouts.home')
@section('title', config('params.appTitle') )
@section('main_contant')
@php 
@endphp
<div class="col-sm-12">
      <!-- ======= About Section ======= -->
      <div class="container">
        <div class="section-title home text-center" data-aos="">
          <h1>Welcome To {{config('params.appTitle')}}</h1>
          <!-- <span>Free Online Tools & Converters</span> -->
        </div>

        <div class="row">
          <div class="col-sm-4">
            <div class="card card-block border-custom mb-3" >
              <div class="card-header">Online Timestamp Converter</div>
              <div class="card-body text-dark">
                <p class="card-text">Convert Timestamp to date & time into your timezone easily on one click.</p>
                <a href=""> Click Here</a>
              </div>
            </div>
          </div>
          

        </div>

        
      </div>
</div>


@endsection
