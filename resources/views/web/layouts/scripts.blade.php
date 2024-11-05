



<script src="{{asset('/assets/selecao/assets/vendor/aos/aos.js') }}"></script>
<script src="{{asset('/assets/selecao/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{asset('/assets/selecao/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{asset('/assets/selecao/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

<script src="{{asset('/assets/selecao/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{asset('/assets/selecao/assets/js/main.js') }}"></script>
<script>
     setTimeout(function(){
         $('.alert-dismissable').slideUp();
     },2000);

     $('.onClickCloseFalse').click(function(event){
         event.stopPropagation();
     });
</script>
