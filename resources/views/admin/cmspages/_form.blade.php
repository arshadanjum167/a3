{!! Form::model($model,['route' => [$route,$model->id],'method'=>$method,'class'=>'','enctype'=>'multipart/form-model']) !!}
<div class="card-body">
        <div class="mt-3">
            <div class="form-group row">
                <label class="control-label text-md-right col-md-3">CMS Particular Name</label>
                <div class="col-md-5">
                {{ Form::text('name',$model->name,['class'=>'form-control','id'=>'name','placeholder'=>'']) }}
                @include('global.show_error',['var_name'=>'name'])
                </div>
            </div>
          <div class="form-group row">
              <label class="control-label text-md-right col-md-3">Content</label>
              <div class="col-md-8">
                  {{ Form::textarea('description',$model->description,['class'=>'cke_wrapper','id'=>'editor1','cols'=>'80','rows'=>'10']) }}
                  @include('global.show_error',['var_name'=>'description'])
              </div>
          </div>
        </div>
    </div>
  <div class="card-footer bg-light text-right">
      <a href="{{ route('admin.cmspages.index') }}" class="btn btn-secondary clear-form">Cancel</a>
      <button type="submit" class="btn btn-primary load-button">Submit</button>
  </div>
{!! Form::close() !!}
