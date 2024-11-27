@extends('web.layouts.home')
@section('title', config('params.appTitle') . ' - ' . config('params.homeTitle') )
@section('main_contant')
@php 
@endphp
  <!-- Carousel Start -->
  <div class="container-fluid p-0 pb-5 wow fadeIn" data-wow-delay="0.1s">
      <div class="owl-carousel header-carousel position-relative">
          <div class="owl-carousel-item position-relative" data-dot="<img src='{{ asset('/assets/img/project-5.jpg') }} ' >">
              <img class="img-fluid" src="{{asset('/assets/img/project-5.jpg') }}" alt="">
              <div class="owl-carousel-inner">
                  <div class="container">
                      <div class="row justify-content-start">
                          <div class="col-10 col-lg-8">
                              <h1 class="display-1 text-white animated1 slideInDown water-effect">Innovative Architecture, Inspired Interiors</h1>
                              <p class="fs-5 fw-medium text-white mb-4 pb-3">At A3 Projects, we blend creativity with precision to bring you cutting-edge architectural designs and beautifully crafted interiors. Our team is dedicated to transforming spaces into inspiring environments that reflect style, functionality, and individuality. Whether building from the ground up or reimagining existing spaces, we turn visions into reality with expert craftsmanship and design insight.</p>
                              <!-- <a href="" class="btn btn-primary py-3 px-5 animated slideInLeft">Read More</a> -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="owl-carousel-item position-relative" data-dot="<img src='{{asset('/assets/img/carousel-2.jpg') }} '>">
              <img class="img-fluid" src="{{asset('/assets/img/carousel-2.jpg') }}" alt="">
              <div class="owl-carousel-inner">
                  <div class="container">
                      <div class="row justify-content-start">
                          <div class="col-10 col-lg-8">
                              <h1 class="display-1 text-white animated1 slideInDown water-effect">Shaping Spaces, Building Futures</h1>
                              <p class="fs-5 fw-medium text-white mb-4 pb-3">A3 Projects is committed to creating environments that stand the test of time, both in design and purpose. Through innovative architecture, thoughtful interiors, and high-quality construction, we shape spaces that support your vision and enrich lives. With a focus on sustainability, functionality, and style, we build for the present with a vision for the future.</p>
                              <!-- <a href="" class="btn btn-primary py-3 px-5 animated slideInLeft">Read More</a> -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="owl-carousel-item position-relative" data-dot="<img src='{{asset('/assets/img/carousel-3.jpg') }} '>">
              <img class="img-fluid" src="{{asset('/assets/img/carousel-3.jpg') }}" alt="">
              <div class="owl-carousel-inner">
                  <div class="container">
                      <div class="row justify-content-start">
                          <div class="col-10 col-lg-8">
                              <h1 class="display-1 text-white animated1 slideInDown water-effect">Creating Timeless Designs for Every Space</h1>
                              <p class="fs-5 fw-medium text-white mb-4 pb-3">At A3 Projects, we believe great design transcends time. Our team specializes in crafting enduring architectural and interior solutions that blend elegance with functionality, tailored to each client’s unique vision. From concept to completion, we bring passion and precision to every project, creating spaces that inspire and stand the test of time.</p>
                              <!-- <a href="" class="btn btn-primary py-3 px-5 animated slideInLeft">Read More</a> -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Carousel End -->
  <!-- About Start -->
  <div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="about-img">
                    <img class="img-fluid" src="{{ asset('/assets/img/about-1.jpg') }}" alt="">
                    <img class="img-fluid" src="{{ asset('/assets/img/about-2.jpg') }}" alt="">
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <h4 class="section-title">About Us</h4>
                <h1 class="display-5 mb-4">A3 Projects</h1>
                <p>Welcome to A3 Projects, where vision meets expertise in construction, interior design, and architecture. Our mission is to transform spaces into inspiring environments that blend functionality with aesthetic appeal. With a team of skilled architects, designers, and construction professionals, we offer end-to-end solutions that cater to diverse project needs — from groundbreaking architectural concepts to detailed interior finishes.</p>
                <p class="mb-4">At A3 Projects, we pride ourselves on our meticulous attention to detail, commitment to quality, and dedication to client satisfaction. Every project we undertake is driven by a passion for design excellence and a commitment to creating spaces that resonate with our clients’ lifestyles and ambitions.
                Whether it’s designing a home, reimagining an office space, or constructing a commercial building, A3 Projects is here to bring your vision to life with precision and creativity. Let us partner with you in building a space you’ll be proud of.</p>
                <div class="d-flex align-items-center mb-5">
                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center border border-5 border-primary" style="width: 120px; height: 120px;">
                        <h1 class="display-1 mb-n2" data-toggle="counter-up">25</h1>
                    </div>
                    <div class="ps-4">
                        <h3>Years</h3>
                        <h3>Working</h3>
                        <h3 class="mb-0">Experience</h3>
                    </div>
                </div>
                <a class="btn btn-primary py-3 px-5" href="{{route('show_about')}}">Read More</a>
            </div>
        </div>
    </div>
  </div>
  <!-- About End -->

  <!-- Project Start -->
  <div class="container-xxl project py-5">
      <div class="container">
          <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
              <h4 class="section-title">Our Projects</h4>
              <h1 class="display-5 mb-4">Visit Our Latest Projects And Our Innovative Works</h1>
          </div>
          <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s">
              
              <div class="col-lg-12">
                  <div class="tab-content w-100">
                      <div class="tab-pane fade show active" id="tab-pane-1">
                          <div class="row g-4">
                              <div class="col-md-6" style="min-height: 350px;">
                                  <a href="project.php" >
                                      <div class="position-relative h-100 product-container">
                                          
                                          <img class="position-absolute img-fluid w-100 h-100  " src="{{ asset('/assets/img/project-1.jpg') }}"
                                              style="object-fit: cover;" alt="">
                                              <div class="product-overlay">
                                                  <h5 class="product-name">Project 1 Name</h5>
                                                  <div class="project-property-name">
                                                      <span>Ahmedabad, Gujarat</span> <span class="project-property"> | Plot: 4500 sq. ft<span>
                                                  </div>
                                                  <a href="project.php" class="view-product-btn">View Project</a>
                                              </div>
                                      </div>
                                  </a>
                              </div>
                              <div class="col-md-6" style="min-height: 350px;">
                                  <a href="project.php" >
                                      <div class="position-relative h-100 product-container">
                                          <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('/assets/img/project-2.jpg') }}"
                                              style="object-fit: cover;" alt="">
                                              <div class="product-overlay">
                                                  <h5 class="product-name">Project 2 Name</h5>
                                                  <div class="project-property-name">
                                                      <span>Ahmedabad, Gujarat</span> <span class="project-property"> | Plot: 4500 sq. ft<span>
                                                  </div>
                                                  <a href="project.php" class="view-product-btn">View Project</a>
                                              </div>
                                      </div>
                                  </a>
                              </div>
                          </div>
                          <br>
                          <div class="row g-4">
                              <div class="col-md-6" style="min-height: 350px;">
                                  <a href="project.php" >
                                      <div class="position-relative h-100 product-container">
                                          
                                          <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('/assets/img/project-3.jpg') }}"
                                              style="object-fit: cover;" alt="">
                                              <div class="product-overlay">
                                                  <h5 class="product-name">Project 3 Name</h5>
                                                  <div class="project-property-name">
                                                      <span>Ahmedabad, Gujarat</span> <span class="project-property"> | Plot: 4500 sq. ft<span>
                                                  </div>
                                                  <a href="project.php" class="view-product-btn">View Project</a>
                                              </div>
                                      </div>
                                  </a>
                              </div>
                              <div class="col-md-6" style="min-height: 350px;">
                                  <a href="project.php" >
                                      <div class="position-relative h-100 product-container">
                                          <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('/assets/img/project-4.jpg') }}"
                                              style="object-fit: cover;" alt="">
                                              <div class="product-overlay">
                                                  <h5 class="product-name">Project 4 Name</h5>
                                                  <div class="project-property-name">
                                                      <span>Ahmedabad, Gujarat</span> <span class="project-property"> | Plot: 4500 sq. ft<span>
                                                  </div>
                                                  <a href="project.php" class="view-product-btn">View Project</a>
                                              </div>
                                      </div>
                                  </a>
                              </div>
                          </div>
                          <br>
                          <div class="row g-4">
                              <div class="col-md-6" style="min-height: 350px;">
                                  <a href="project.php" >
                                      <div class="position-relative h-100 product-container">
                                          
                                          <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('/assets/img/project-5.jpg') }}"
                                              style="object-fit: cover;" alt="">
                                              <div class="product-overlay">
                                                  <h5 class="product-name">Project 5 Name</h5>
                                                  <div class="project-property-name">
                                                      <span>Ahmedabad, Gujarat</span> <span class="project-property"> | Plot: 4500 sq. ft<span>
                                                  </div>
                                                  <a href="project.php" class="view-product-btn">View Project</a>
                                              </div>
                                      </div>
                                  </a>
                              </div>
                              <div class="col-md-6" style="min-height: 350px;">
                                  <a href="project.php" >
                                      <div class="position-relative h-100 product-container">
                                          <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('/assets/img/project-6.jpg') }}"
                                              style="object-fit: cover;" alt="">
                                              <div class="product-overlay">
                                                  <h5 class="product-name">Project 6 Name</h5>
                                                  <div class="project-property-name">
                                                      <span>Ahmedabad, Gujarat</span> <span class="project-property"> | Plot: 4500 sq. ft<span>
                                                  </div>
                                                  <a href="project.php" class="view-product-btn">View Project</a>
                                              </div>
                                      </div>
                                  </a>
                              </div>
                          </div>
                          <br>
                          <div class="row g-4">
                              <div class="col-md-6" style="min-height: 350px;">
                                  <a href="project.php" >
                                      <div class="position-relative h-100 product-container">
                                          
                                          <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('/assets/img/project-7.jpg') }}"
                                              style="object-fit: cover;" alt="">
                                              <div class="product-overlay">
                                                  <h5 class="product-name">Project 7 Name</h5>
                                                  <div class="project-property-name">
                                                      <span>Ahmedabad, Gujarat</span> <span class="project-property"> | Plot: 4500 sq. ft<span>
                                                  </div>
                                                  <a href="project.php" class="view-product-btn">View Project</a>
                                              </div>
                                      </div>
                                  </a>
                              </div>
                              <div class="col-md-6" style="min-height: 350px;">
                                  <a href="project.php" >
                                      <div class="position-relative h-100 product-container">
                                          <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('/assets/img/project-8.jpg') }}"
                                              style="object-fit: cover;" alt="">
                                              <div class="product-overlay">
                                                  <h5 class="product-name">Project 8 Name</h5>
                                                  <div class="project-property-name">
                                                      <span>Ahmedabad, Gujarat</span> <span class="project-property"> | Plot: 4500 sq. ft<span>
                                                  </div>
                                                  <a href="project.php" class="view-product-btn">View Project</a>
                                              </div>
                                      </div>
                                  </a>
                              </div>
                          </div>

                          <br>
                          <div class="row g-4">
                              <div class="col-md-6" style="min-height: 350px;">
                                  <a href="project.php" >
                                      <div class="position-relative h-100 product-container">
                                          
                                          <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('/assets/img/project-9.jpg') }}"
                                              style="object-fit: cover;" alt="">
                                              <div class="product-overlay">
                                                  <h5 class="product-name">Project 9 Name</h5>
                                                  <div class="project-property-name">
                                                      <span>Ahmedabad, Gujarat</span> <span class="project-property"> | Plot: 4500 sq. ft<span>
                                                  </div>
                                                  <a href="project.php" class="view-product-btn">View Project</a>
                                              </div>
                                      </div>
                                  </a>
                              </div>
                              <div class="col-md-6" style="min-height: 350px;">
                                  <a href="project.php" >
                                      <div class="position-relative h-100 product-container">
                                          <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('/assets/img/project-10.jpg') }}"
                                              style="object-fit: cover;" alt="">
                                              <div class="product-overlay">
                                                  <h5 class="product-name">Project 10 Name</h5>
                                                  <div class="project-property-name">
                                                      <span>Ahmedabad, Gujarat</span> <span class="project-property"> | Plot: 4500 sq. ft<span>
                                                  </div>
                                                  <a href="project.php" class="view-product-btn">View Project</a>
                                              </div>
                                      </div>
                                  </a>
                              </div>
                          </div>

                          <br>
                          <div class="row g-4">
                              <div class="col-md-6" style="min-height: 350px;">
                                  <a href="project.php" >
                                      <div class="position-relative h-100 product-container">
                                          
                                          <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('/assets/img/project-11.jpg') }}"
                                              style="object-fit: cover;" alt="">
                                              <div class="product-overlay">
                                                  <h5 class="product-name">Project 11 Name</h5>
                                                  <div class="project-property-name">
                                                      <span>Ahmedabad, Gujarat</span> <span class="project-property"> | Plot: 4500 sq. ft<span>
                                                  </div>
                                                  <a href="project.php" class="view-product-btn">View Project</a>
                                              </div>
                                      </div>
                                  </a>
                              </div>
                              <div class="col-md-6" style="min-height: 350px;">
                                  <a href="project.php" >
                                      <div class="position-relative h-100 product-container">
                                          <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('/assets/img/project-13.jpg') }}"
                                              style="object-fit: cover;" alt="">
                                              <div class="product-overlay">
                                                  <h5 class="product-name">Project 12 Name</h5>
                                                  <div class="project-property-name">
                                                      <span>Ahmedabad, Gujarat</span> <span class="project-property"> | Plot: 4500 sq. ft<span>
                                                  </div>
                                                  <a href="project.php" class="view-product-btn">View Project</a>
                                              </div>
                                      </div>
                                  </a>
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
