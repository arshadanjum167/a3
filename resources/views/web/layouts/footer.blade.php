
<!-- Footer Start -->
<div class="container-fluid bg-dark text-body footer mt-5 pt-5 px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-light mb-4">Address</h3>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>C-502, Rajyash Rise,Nr Vishala Circle,Ahmabadad,Gujarat-380007</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary me-3"></i>{{config('params.admin_contactus_phone')}}</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>{{config('params.admin_contactus_email')}}</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-body me-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-body me-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-body me-1" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-body me-0" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <!-- <div class="col-lg-3 col-md-6">
                    <h3 class="text-light mb-4">Services</h3>
                    <a class="btn btn-link" href="">Architecture</a>
                    <a class="btn btn-link" href="">3D Animation</a>
                    <a class="btn btn-link" href="">House Planning</a>
                    <a class="btn btn-link" href="">Interior Design</a>
                    <a class="btn btn-link" href="">Construction</a>
                </div> -->
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-light mb-4">Quick Links</h3>
                    <a class="btn btn-link" href="{{route('show_about')}}">About Us</a>
                    <a class="btn btn-link" href="{{route('show_contactus')}}">Contact Us</a>
                    <a class="btn btn-link" href="testimonial.php">Testimonials</a>
                    <a class="btn btn-link" href="{{route('show_award')}}">Awards</a>
                    <a class="btn btn-link" href="feature.php">Features & Recognitions</a>
                </div>
                <!-- <div class="col-lg-3 col-md-6">
                    <h3 class="text-light mb-4">Newsletter</h3>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="container-fluid copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a href="#">Copyright <?php echo date("Y");  echo " ".config('params.appTitle')?> </a>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        
                        Developed By <a href="https://zujajah.com" target="_blank" titlt="Zujajah">Zujajah</a>
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- Footer End -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border position-relative text-primary" style="width: 6rem; height: 6rem;" role="status"></div>
        <img class="position-absolute top-50 start-50 translate-middle " src="{{asset('/assets/img/logo.png')}}" alt="Icon">
</div>
<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>