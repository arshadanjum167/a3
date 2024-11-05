{!! Form::model($model,['route' => [$route,$model->id],'method'=>$method,'class'=>'','enctype'=>'multipart/form-data']) !!}
  <div class="card-body">
    <div class="left-form-content pull-left">
        <div class="clearfix">
            <div class="fileinput text-center fileinput-new" data-provides="fileinput">
                <div class="btn-file mt-3">
                    <div class="thumbnail fileinput-new uploaded-user-image rounded-circle" style="width: 150px; height: 150px;">
                        <img src="{{ URL::asset($data['image']) }}" alt="">
                    </div>
                    <div class="clearfix"></div>
                    <button class="fileinput-new btn btn-primary2 btn-sm btn-file mt-3"> Browse Image </button>
                    <input type="hidden" value="" name="...">
                    <input type="file" file-model="myFile" name="image" accept="image/x-png,image/gif,image/jpeg">
                    <div class="fileinput-preview fileinput-exists thumbnail uploaded-user-image rounded-circle" style="width: 150px; height: 150px;"></div>
                </div>
                <div class="text-center">
                    <button href="javascript:;" class="btn btn-link btn-sm fileinput-exists mt-3" data-dismiss="fileinput"> Remove </button>
                </div>
                <div class="clearfix mt-3">
                    <!-- <p class="upload-img-label text-muted">*Recommended Size:<br>Minimum 250 * 250</p> -->
                </div>
            </div>
        </div>
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
                            <label>Content</label>
                            {{ Form::textarea('content',null,['class'=>'cke_wrapper','id'=>'editor1','cols'=>'80','rows'=>'10']) }}
                            @include('global.show_error',['var_name'=>'content'])
                        </div>
                        <div class="form-group">
                            <label>Name of Route</label>
                            {{ Form::text('route_name',null,['class'=>'form-control','id'=>'route_name']) }}
                            @include('global.show_error',['var_name'=>'route_name'])
                        </div>
                        <div class="form-group">
                            <label>Read Duration</label>
                            {{ Form::text('read_duration',null,['class'=>'form-control','id'=>'read_duration']) }}
                            @include('global.show_error',['var_name'=>'read_duration'])
                        </div>
                        <div class="form-group">
                            <label>Meta Description</label>
                            {{ Form::text('meta_description',null,['class'=>'form-control','id'=>'meta_description']) }}
                            @include('global.show_error',['var_name'=>'meta_description'])
                        </div>
                        <div class="form-group">
                            <label>Meta Keyword</label>
                            {{ Form::text('meta_keyword',null,['class'=>'form-control','id'=>'meta_keyword']) }}
                            @include('global.show_error',['var_name'=>'meta_keyword'])
                        </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  {{-- Form::hidden('redirects_to', $back_url) --}}
  <div class="card-footer bg-light text-right">
      <a href="{{ route('admin.blog.index')}}" class="btn btn-secondary clear-form">Cancel</a>
      {{--<a href="{{ $back_url }}" class="btn btn-secondary clear-form">Cancel</a> --}}
      <button type="submit" class="btn btn-primary load-button">Submit</button>

  </div>
{!! Form::close() !!}


@section('custom_scripts')
<!-- <script src="{{asset('/assets/vendor/ckeditor/ckeditor.js') }}"></script> -->
<script src="https://cdn.ckeditor.com/4.19.1/full/ckeditor.js"></script>


<script>
    // CKEDITOR.replace( 'editor1' );
    jQuery(function () {
       	CKEDITOR.replace('editor1');
       	CKEDITOR.config.height = 400;
	   	CKEDITOR.config.allowedContent = true;
        CKEDITOR.config.protectedSource.push( /<ins[\s|\S]+?<\/ins>/g); // Protects <INS> tags
        CKEDITOR.config.protectedSource.push( /<ins class=\"adsbygoogle\"\>.*?<\/ins\>/g );

    });
</script>
@endsection
