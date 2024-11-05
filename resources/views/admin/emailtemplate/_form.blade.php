{!! Form::model($model,['route' => [$route,$model->id],'method'=>$method,'class'=>'','enctype'=>'multipart/form-data']) !!}
  <div class="card-body">
      <div class="row">
          <div class="col-xl-10">
              <div class="form-row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label>Email Subject</label>
                          {{ Form::text('title',null,['class'=>'form-control','id'=>'title']) }}
                           @include('global.show_error',['var_name'=>'title'])
                      </div>
                        <div class="form-group">
                            <label>Email Content</label>
                            {{ Form::textarea('content',null,['class'=>'cke_wrapper','id'=>'editor1','cols'=>'80','rows'=>'10']) }}
                            @include('global.show_error',['var_name'=>'content'])
                        </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  {{-- Form::hidden('redirects_to', $back_url) --}}
  <div class="card-footer bg-light text-right">
      <a href="{{ route('admin.emailtemplates.index')}}" class="btn btn-secondary clear-form">Cancel</a>
      {{--<a href="{{ $back_url }}" class="btn btn-secondary clear-form">Cancel</a> --}}
      <button type="submit" class="btn btn-primary load-button">Submit</button>

  </div>
{!! Form::close() !!}


@section('custom_scripts')
<script src="{{asset('/assets/vendor/ckeditor/ckeditor.js') }}"></script>

<script>
    // CKEDITOR.replace( 'editor1' );
    jQuery(function () {
       	CKEDITOR.replace('editor1');
       	CKEDITOR.config.height = 400;
	   	CKEDITOR.config.allowedContent = true;
    });
</script>
@endsection
