
@extends('web.layouts.home')
@section('title', $title.' - ' .config('params.appTitle')) 
@section('main_contant')

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-1 text-white animated slideInDown">Project</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb text-uppercase mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="{{route('web_home')}}">Home</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">{{ $model->title}}</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->
<!-- Team Start -->
<div class="container-xxl py-5">
      <div class="container">
          <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
              <h1 class="display-5 mb-4"><?php echo $model['title']?></h1>
              <h4 class="section-title"><span><?php echo $model['address']??'N/A'?></span> <span class="project-property"> | <?php echo $model['description']??'N/A'?><span></h4>
          </div>
          <?php 
          // dd($model->media);
          if(isset($model->media) && $model->media != null){
            
            $imageChunks = array_chunk($model->media->toArray(), 3);

            foreach($imageChunks as $chunk){
              
          ?>
            <div class="row g-0 team-items">
                <?php foreach ($chunk as $index => $value){
                   ?>  
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.<?php echo $index+1?>s">
                    <div class="team-item position-relative">
                        <div class="position-relative image-container">
                            <img class="img-fluid project-image" src="{{$value['link']??''}}" alt="">
                        </div>
                    </div>
                </div>
                
                <?php 
                } ?>
            </div>
          
          <?php } 
          } ?>

          <!-- <div class="row g-0 team-items">
              <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                  <div class="team-item position-relative">
                      <div class="position-relative image-container">
                          <img class="img-fluid project-image" src="img/project-7.jpg" alt="">
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                  <div class="team-item position-relative">
                      <div class="position-relative image-container">
                          <img class="img-fluid project-image" src="img/project-8.jpg" alt="">
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                  <div class="team-item position-relative">
                      <div class="position-relative image-container">
                          <img class="img-fluid project-image" src="img/project-9.jpg" alt="">
                      </div>
                  </div>
              </div>
          </div> -->
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