
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
                <li class="breadcrumb-item text-primary active" aria-current="page">Case-study</li>
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
                if(isset($casestudy) && $casestudy){
                    // dd($testimonials[0]->preview_url);
                    // $imageChunks = array_chunk($testimonials, 2);
                    foreach($casestudy as $index => $chunk){
                        
                ?>
                <!-- <iframe width="400" height="315" src="{{$chunk->embed_url }}"
                            title="{{$chunk->title}}" frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> -->
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.<?php echo $index+1?>s">
                        <div class="team-item position-relative">
                            <div class="position-relative" style="max-height:350px">                        
                                <a href="{{url('case-study/'.$chunk['route_name'])}}" >
                                <img src="<?php echo $chunk->link?$chunk->link:'/assets/img/logo.png' ?>" alt="{{$chunk->title}}" width="100%" style="max-height:350px " />
                                <div class="image-title-overlay">
                                    {{$chunk->title}}
                                </div>
                               
                                </a>
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


@endsection
@section('custom_scripts')
<script>

</script>
@endsection