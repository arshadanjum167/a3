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
                            <label>Youtub Link</label>
                            {{ Form::text('link',null,['class'=>'form-control','id'=>'link']) }}
                            @include('global.show_error',['var_name'=>'link'])
                        </div>
                        <div class="form-group">
                            <label>Name of Route</label>
                            {{ Form::text('route_name',null,['class'=>'form-control','id'=>'route_name']) }}
                            @include('global.show_error',['var_name'=>'route_name'])
                        </div>
                               
                        
                  </div>
              </div>
          </div>
      </div>
  </div>
  {{-- Form::hidden('redirects_to', $back_url) --}}
  <div class="card-footer bg-light text-right">
      <a href="{{ route('admin.testimonial.index')}}" class="btn btn-secondary clear-form">Cancel</a>
      {{--<a href="{{ $back_url }}" class="btn btn-secondary clear-form">Cancel</a> --}}
      <button type="submit" class="btn btn-primary load-button">Submit</button>

  </div>
{!! Form::close() !!}


@section('custom_scripts')

<!-- <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script> -->

<script>
    // CKEDITOR.replace( 'editor1' );
  
</script>
@endsection
