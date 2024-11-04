<!DOCTYPE html>
<html lang="en">

<!-- Head Start -->
<?php include_once('head.php'); ?>
 <!-- Head End -->

<body>
    <!-- Spinner Start -->
    <?php include_once('spinner.php'); ?>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <!-- <div class="container-fluid bg-dark p-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-3">
                    <a class="text-body px-2" href="tel:+0123456789"><i class="fa fa-phone-alt text-primary me-2"></i>+012 345 6789</a>
                    <a class="text-body px-2" href="mailto:aatib.53@gmail.com"><i class="fa fa-envelope-open text-primary me-2"></i>aatib.53@gmail.com</a>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center py-3 me-2">
                    <a class="text-body px-2" href="">Terms</a>
                    <a class="text-body px-2" href="">Privacy</a>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn btn-sm-square btn-outline-body me-1" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-sm-square btn-outline-body me-1" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-sm-square btn-outline-body me-1" href=""><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-sm-square btn-outline-body me-0" href=""><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <?php include_once('navbar.php'); ?>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-1 text-white animated slideInDown">Project</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="./">Home</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Project 1 Name</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Project Start -->
    <!-- <div class="container-xxl project py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h4 class="section-title">Our Projects</h4>
                <h1 class="display-5 mb-4">Visit Our Latest Projects And Our Innovative Works</h1>
            </div>
            
        </div>
    </div> -->
    <!-- Project End -->
     <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            
            <div class="row g-0 team-items">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item position-relative">
                        <div class="position-relative image-container">
                            <img class="img-fluid project-image" src="img/project-1" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item position-relative">
                        <div class="position-relative image-container">
                            <img class="img-fluid project-image" src="img/project-2" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item position-relative">
                        <div class="position-relative image-container">
                            <img class="img-fluid project-image" src="img/project-3" alt="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-0 team-items">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item position-relative">
                        <div class="position-relative image-container">
                            <img class="img-fluid project-image" src="img/project-7" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item position-relative">
                        <div class="position-relative image-container">
                            <img class="img-fluid project-image" src="img/project-8" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item position-relative">
                        <div class="position-relative image-container">
                            <img class="img-fluid project-image" src="img/project-9" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->

    <!-- Modal for Image Popup -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <img id="modalImage" class="img-fluid w-100" src="" alt="">
                </div>
            </div>
        </div>
    </div>
        

    <!-- Footer Start -->
    <?php include_once('footer.php'); ?>
    <!-- Footer End -->
<script>
    document.querySelectorAll('.project-image').forEach(img => {
    img.addEventListener('click', function () {
        const modalImage = document.getElementById('modalImage');
        modalImage.src = this.src; // Set the modal image source to the clicked image source
        const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        imageModal.show();
    });
});
</script>



    
</body>

</html>