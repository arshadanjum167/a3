(function(window, document, $, undefined) {
	  "use strict";
	$(function() {
          
           //select2
          $(".select2").select2();
//	  $(".onClickCloseFalse .select2").select2(function(event){
//                    event.stopPropagation();
//                    dropdownParent: $('.onClickCloseFalse')
//          });
                
          // multi select
		$('.multiple').select2({
			placeholder: "User Name",
                        //selectOnClose: false,
                        closeOnSelect: false
		});


	});

})(window, document, window.jQuery);
