
@extends('web.layouts.home')
@section('title', $title.' - ' .config('params.appTitle')) 
@section('main_contant')

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-1 text-white animated slideInDown">Awards</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{route('web_home')}}">Home</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Awards</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h4 class="section-title">Awards</h4>
                <span class="display--5 mb-4">A3 Projects is proud to be recognized for our dedication to excellence in construction, interior design, and architecture. These awards reflect our commitment to innovation, quality, and client satisfaction, driving us to continue shaping spaces that inspire. We are honored to be celebrated by industry leaders and grateful for the trust our clients place in us every day.</span>
            </div>
            <div class="row g-0 team-items">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item position-relative">
                        <div class="position-relative">
                            <img class="img-fluid" src="{{ asset('/assets/img/main-logo.png') }}" alt="">
                           
                        </div>
                        <div class="bg-light text-center p-4">
                            <h3 class="mt-2">Award 1</h3>
                            <span class="text-primary">Award 1 Description</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item position-relative">
                        <div class="position-relative">
                            <img class="img-fluid" src="{{ asset('/assets/img/main-logo.png') }}" alt="">
                           
                        </div>
                        <div class="bg-light text-center p-4">
                            <h3 class="mt-2">Award 2</h3>
                            <span class="text-primary">Award 2 Description</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item position-relative">
                        <div class="position-relative">
                            <img class="img-fluid" src="{{ asset('/assets/img/main-logo.png') }}" alt="">
                           
                        </div>
                        <div class="bg-light text-center p-4">
                            <h3 class="mt-2">Award 3</h3>
                            <span class="text-primary">Award 3 Description</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item position-relative">
                        <div class="position-relative">
                            <img class="img-fluid" src="{{ asset('/assets/img/main-logo.png') }}" alt="">
                           
                        </div>
                        <div class="bg-light text-center p-4">
                            <h3 class="mt-2">Award 4</h3>
                            <span class="text-primary">Award 4 Description</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item position-relative">
                        <div class="position-relative">
                            <img class="img-fluid" src="{{ asset('/assets/img/main-logo.png') }}" alt="">
                           
                        </div>
                        <div class="bg-light text-center p-4">
                            <h3 class="mt-2">Award 5</h3>
                            <span class="text-primary">Award 5 Description</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item position-relative">
                        <div class="position-relative">
                            <img class="img-fluid" src="{{ asset('/assets/img/main-logo.png') }}" alt="">
                           
                        </div>
                        <div class="bg-light text-center p-4">
                            <h3 class="mt-2">Award 6</h3>
                            <span class="text-primary">Award 6 Description</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item position-relative">
                        <div class="position-relative">
                            <img class="img-fluid" src="{{ asset('/assets/img/main-logo.png') }}" alt="">
                           
                        </div>
                        <div class="bg-light text-center p-4">
                            <h3 class="mt-2">Award 7</h3>
                            <span class="text-primary">Award 7 Description</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item position-relative">
                        <div class="position-relative">
                            <img class="img-fluid" src="{{ asset('/assets/img/main-logo.png') }}" alt="">
                           
                        </div>
                        <div class="bg-light text-center p-4">
                            <h3 class="mt-2">Award 8</h3>
                            <span class="text-primary">Award 8 Description</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->

@endsection