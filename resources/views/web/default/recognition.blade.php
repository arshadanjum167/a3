
@extends('web.layouts.home')
@section('title', $title.' - ' .config('params.appTitle')) 
@section('main_contant')

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-1 text-white animated slideInDown">About Us</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{route('web_home')}}">Home</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Features & Recognitions</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


     <!-- Project Start -->
     <div class="container-xxl project py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h4 class="section-title">Features & Recognitions</h4>
                <span class="display--5 mb-4">A3 Projects has been featured in renowned industry publications and recognized for our innovative approach to construction, interior design, and architecture. These accolades highlight our commitment to pushing boundaries and setting standards in quality and creativity. We’re honored to be acknowledged for our work and strive to continue delivering spaces that stand out and inspire.</span>
            </div>
            <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s">
                
                <div class="col-lg-12">
                    <div class="tab-content w-100">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <div class="row g-4">
                                <div class="col-md-4" style="min-height: 350px;">
                                        <div class="position-relative h-100 product-container">
                                            
                                            <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('/assets/img/main-logo.png') }}"
                                                style="object-fit: cover;" alt="">
                                                <div class="product-overlay">
                                                    <h5 class="product-name">Home world desing 2024</h5>
                                                    <div class="project-property-name">
                                                        <span></span> <span class="project-property"> Publications <span>
                                                    </div>
                                                    <!-- <a href="#" class="view-product-btn">View Product</a> -->
                                                </div>
                                        </div>
                                </div>
                                <div class="col-md-4" style="min-height: 350px;">
                                        <div class="position-relative h-100 product-container">
                                            <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('/assets/img/main-logo.png') }}"
                                                style="object-fit: cover;" alt="">
                                                <div class="product-overlay">
                                                    <h5 class="product-name">India Decor Ideas</h5>
                                                    <div class="project-property-name">
                                                        <span></span> <span class="project-property"> Publications <span>
                                                    </div>
                                                    <!-- <a href="#" class="view-product-btn">View Product</a> -->
                                                </div>
                                        </div>
                                </div>
                                <div class="col-md-4" style="min-height: 350px;">
                                        <div class="position-relative h-100 product-container">
                                            <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('/assets/img/main-logo.png') }}"
                                                style="object-fit: cover;" alt="">
                                                <div class="product-overlay">
                                                    <h5 class="product-name">INTERIOR EXTERIOR MAGAZINE 2023</h5>
                                                    <div class="project-property-name">
                                                        <span></span> <span class="project-property"> Publications <span>
                                                    </div>
                                                    <!-- <a href="#" class="view-product-btn">View Product</a> -->
                                                </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Project End -->

@endsection