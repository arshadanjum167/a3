{!! Form::model($model,['route' => [$route,$model->id],'method'=>$method,'class'=>'','enctype'=>'multipart/form-data']) !!}
  <div class="card-body">
    <div class="left-form-content pull-left">
        
        @include('global.show_error',['var_name'=>'image'])
    </div>
      <div class="row">
          <div class="col-xl-10">
              <div class="form-row">
                  <div class="col-md-12">
                        <div class="form-group">
                            <label>Title</label>
                            {{ Form::text('title',null,['class'=>'form-control','id'=>'title']) }}
                            @include('global.show_error',['var_name'=>'title'])
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            {{ Form::textarea('description',null,['class'=>'cke_wrapper form-control','id'=>'editor111','cols'=>'80','rows'=>'10']) }}
                            @include('global.show_error',['var_name'=>'description'])
                        </div>
                        
                        <div class="form-group">
                            <label>Name of Route</label>
                            {{ Form::text('route_name',null,['class'=>'form-control','id'=>'route_name']) }}
                            @include('global.show_error',['var_name'=>'route_name'])
                        </div>
                               
                        <div class="form-group">
                            <label>Image</label>
                                <div class="clearfix">
                                
                                <?php 
                                    for($i=0; $i < 1; $i++) { ?>
                                        <div class="fileinput text-center fileinput-new mr-5" data-provides="fileinput">
                                                <div class="btn-file mt-3">
                                                    <div class="thumbnail fileinput-new uploaded-user-image rounded-circle" style="width: 150px; height: 150px;">
                                                        <img src="{{ URL::asset($data['image'][$i]) }}" alt="">
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <?php if(isset($data['isImageExist']) && $data['isImageExist'][$i] == 0){?>
                                                    <button class="fileinput-new btn btn-primary2 btn-sm btn-file mt-3"> Browse Image </button>
                                                    <?php }?>
                                                    
                                                    <input type="hidden" value="" name="...">

                                                    <input type="file" file-model="myFile" name="image[<?php echo $i;?>]" accept="image/x-png,image/gif,image/jpeg">
                                                    <div class="fileinput-preview fileinput-exists thumbnail uploaded-user-image rounded-circle" style="width: 150px; height: 150px;"></div>
                                            </div>
                                            <?php if(isset($data['isImageExist']) && $data['isImageExist'][$i] == 0){?>
                                            <?php } else {?>
                                                <button type="button" data-id="<?php echo $data['mediaId'][$i];?>" class="btn btn-accent btn-sm btn-file mt-3 remove-image"> Remove Image </button>
                                            <?php } ?>
                                            <div class="text-center">
                                                <button href="javascript:;" class="btn btn-link btn-sm fileinput-exists mt-3" data-dismiss="fileinput"> Remove </button>
                                            </div>
                                            <div class="clearfix mt-3">
                                                <!-- <p class="upload-img-label text-muted">*Recommended Size:<br>Minimum 250 * 250</p> -->
                                            </div>
                                        </div>
                                    <?php 
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  {{-- Form::hidden('redirects_to', $back_url) --}}
  <div class="card-footer bg-light text-right">
      <a href="{{ route('admin.case-study.index')}}" class="btn btn-secondary clear-form">Cancel</a>
      {{--<a href="{{ $back_url }}" class="btn btn-secondary clear-form">Cancel</a> --}}
      <button type="submit" class="btn btn-primary load-button">Submit</button>

  </div>
{!! Form::close() !!}


@section('custom_scripts')



<script>
    $(document).on('click', '.remove-image', function () {
    var mediaId = $(this).data('id');
    if (confirm('Are you sure you want to remove this image?')) {
        $.ajax({
            type: 'GET',         // HTTP method
            async: false,
            url: "{{  route('admin.case-study.remove_image') }}",
            data: {
                media_id: mediaId,
            },
            success: function (response) {
                if (response.success) {
                    location.reload(); // Reloads the current page
                    // Optionally remove the image from the DOM
                    // $(this).closest('div').remove(); // Adjust the selector as needed
                } else {
                    alert('Failed to remove the image.');
                }
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('An error occurred while processing the request.');
            }
        });
    }
});
  
</script>
@endsection
