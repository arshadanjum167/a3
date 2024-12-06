
@extends('web.layouts.home')
@section('title', $title.' - ' .config('params.appTitle')) 
@section('main_contant')

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-1 text-white animated slideInDown">Case-study</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb text-uppercase mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="{{route('web_home')}}">Home</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">{{ $model->title}}</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->
  <!-- About Start -->
  <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="about-img1" style="max-height:480;max-width:480;">
                        <img class="img-fluid" src="<?php echo $model->link?$model->link:'/assets/img/logo.png' ?> " alt="" style="max-height:480;max-width:480;">
                        <!-- <img class="img-fluid" src="{{ asset('/assets/img/about-2.jpg') }} " alt=""> -->
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h4 class="section-title">Case-study</h4>
                    <h1 class="display-5 mb-4"><?php echo $model['title']?></h1>
                    
                    <div class="d-flex align-items-center mb-5">
                        
                        <div class="">
                            
                            <?php echo $model['description']??'N/A'?>
                            
                        </div>
                    </div>
                    <!-- <a class="btn btn-primary py-3 px-5" href="">Read More</a> -->
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


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
@endsection
@section('custom_scripts')
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
@endsection