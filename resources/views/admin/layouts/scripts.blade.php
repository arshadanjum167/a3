<script src="{{asset('/assets/vendor/modernizr/modernizr.custom.js') }}"></script>
<script src="{{asset('/assets/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{asset('/assets/js/scripts/jquery.validate.min.js') }}"></script>
<script src="{{asset('/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{asset('/assets/vendor/js-storage/js.storage.js') }}"></script>
<script src="{{asset('/assets/vendor/js-cookie/src/js.cookie.js') }}"></script>
<script src="{{asset('/assets/vendor/pace/pace.js') }}"></script>
<script src="{{asset('/assets/vendor/metismenu/dist/metisMenu.js') }}"></script>
<script src="{{asset('/assets/vendor/switchery-npm/index.js') }}"></script>
<script src="{{asset('/assets/vendor/select2/select2.min.js') }}"></script>
<script src="{{asset('/assets/vendor/moment/min/moment.min.js') }}"></script>
<script src="{{asset('/assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{asset('/assets/vendor/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{asset('/assets/vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{asset('/assets/js/components/bootstrap-datepicker-init.js') }}"></script>
<script src="{{asset('/assets/js/components/bootstrap-date-range-picker-init.js') }}"></script>
<script src="{{asset('/assets/vendor/bootstrap-fileinput/bootstrap-fileinput.js') }}"></script>
<script src="{{asset('/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{asset('/assets/js/components/custom-scrollbar.js') }}"></script>
<script src="{{asset('/assets/js/components/select2-init.js') }}"></script>
<script src="{{asset('/assets/js/global/app.js') }}"></script>
<script src="{{ asset('assets/js/components/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/vendor/fancybox/jquery.fancybox.pack.js?v=2.1.5') }}"></script>
<script>
     setTimeout(function(){
         $('.alert-dismissable').slideUp();
     },2000);

     $('.onClickCloseFalse').click(function(event){
         event.stopPropagation();
     });
     $(document).ready(function() {
        $("a.example1").fancybox();
    });

    $('.dropdown-toggle').click(function (){
        dropDownFixPosition($('.dropdown-menu'));
        });
        function dropDownFixPosition(button,dropdown){
        var dropDownTop = button.offset().top + button.outerHeight();


        }
    //    $(that._countrySelect).data('select2').on('open', function (e) {
    // this.results.clear();
    // this.dropdown._positionDropdown();
// });

</script>
