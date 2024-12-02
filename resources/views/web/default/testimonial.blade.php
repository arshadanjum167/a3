
@extends('web.layouts.home')
@section('title', $title.' - ' .config('params.appTitle')) 
@section('main_contant')

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-1 text-white animated slideInDown">Testimonials</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb text-uppercase mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="{{route('web_home')}}">Home</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Testimonial</li>
            </ol>
        </nav>
    </div>
</div>
    <!-- Page Header End -->


    


    


    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-0 team-items">
            <?php 
                if(isset($testimonials) && $testimonials){
                    // dd($testimonials[0]->preview_url);
                    // $imageChunks = array_chunk($testimonials, 2);
                    foreach($testimonials as $index => $chunk){
                        
                ?>
                <!-- <iframe width="400" height="315" src="{{$chunk->embed_url }}"
                            title="{{$chunk->title}}" frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> -->
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.<?php echo $index+1?>s">
                        <div class="team-item position-relative">
                            <div class="position-relative" data-bs-toggle="modal" data-bs-target="#videoModal" data-title="{{$chunk->title}}" data-url="{{$chunk->embed_url}}">                        
                                <img src="https://img.youtube.com/vi/{{$chunk->preview_url}}/hqdefault.jpg" alt="{{$chunk->title}}" width="100%" />
                                <div class="image-title-overlay">
                                    {{$chunk->title}}
                                </div>
                                <div class="play-icon">
                                    <i class="fa fa-play"></i>
                                </div>
                            </div> 
                        </div>
                    </div>
                <?php 
                }
                } ?>
            </div>
        </div>
    </div>
    <!-- Team End -->
     <!-- Modal -->
<div class="modal fade " id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-fullscreen-xl-down modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="videoModalLabel">Video Title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="videoIframe" width="100%" height="400" src="" 
                frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

@endsection
@section('custom_scripts')
<script>
// When the modal is shown
$('#videoModal').on('show.bs.modal', function (event) {
    // Get the button that triggered the modal
    var button = $(event.relatedTarget); 
    
    // Get the data-title and data-url attributes
    var title = button.data('title');
    var url = button.data('url');
    
    // Set the title of the modal
    var modal = $(this);
    modal.find('.modal-title').text(title);
    
    // Set the src of the iframe to the video URL
    modal.find('#videoIframe').attr('src', url + "?autoplay=1");
});

// When the modal is hidden, remove the video URL to stop the video from playing
$('#videoModal').on('hidden.bs.modal', function () {
    $(this).find('#videoIframe').attr('src', '');
});
</script>
@endsection