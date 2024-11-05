<script type="text/javascript">
    function approved_by_admin_status_change(status,id)
      {
       var id1 = id;
       var val1 = status;
    
       $.ajax({
             url: "{{ route($route)}}",
             type: "GET",
             data: {status:val1,id:id1},
             success: function(value){
               console.log(value);
               if(value==0){
                 alert("error");
               }
               else{
                 location.reload();
               }
             },
             error: function(value){
               console.log('error');
             }
         });
    }
    </script>
    