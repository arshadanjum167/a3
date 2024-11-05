@php
  $country_codelist = CommonFunction::getCountryCode();
  $marinas_list = CommonFunction::getMarinasList();
  $slip_number_list = array();

    if($model->marina_detail_id){
        $marina_detail_id = $model->marina_detail_id;
    }else{
        $marina_detail_id = 0;
    }
  


@endphp
{!! Form::model($model,['route' => [$route,$model->id],'method'=>$method,'id'=>'user-form','enctype'=>'multipart/form-model']) !!}
  <div class="card-body">
      <div class="clearfix">
          <div class="row">
              <div class="col-md-8">
                  <div class="form-row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label class="control-label">Full Name</label>
                              {{ Form::text('full_name',$model->full_name,['class'=>'form-control','id'=>'full_name','placeholder'=>'']) }}
                              @include('global.show_error',['var_name'=>'full_name'])
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="control-label">Mobile Number</label>
                              <div class="input-group">
                                {{ Form::select('country_code',$country_codelist,$model->country_code,['class'=>'form-control select2','id'=>'country_code','style'=>"width: 85px;"]) }}
                                {{ Form::text('contact_number',$model->contact_number,['class'=>'form-control border-left-0 ','id'=>'contact_number','maxlength'=>11]) }}
                              </div>
                              @include('global.show_error',['var_name'=>'country_code'])
                              @include('global.show_error',['var_name'=>'contact_number'])
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="control-label">Marina Name</label>
                              {{ Form::select('marina_id',$marinas_list,$model->marina_id,['class'=>'form-control select2','id'=>'marina_id','style'=>"width: 100%"]) }}
                              @include('global.show_error',['var_name'=>'marina_id'])
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="control-label">Slip Number</label>
                              {{-- Form::text('slip_number',$model->slip_number,['class'=>'form-control','id'=>'slip_number','placeholder'=>'','minlength'=>2,'maxlength'=>50]) --}}
                              {{ Form::select('slip_number',$slip_number_list,$model->slip_number,['class'=>'form-control select2','id'=>'slip_number','style'=>"width: 100%"]) }}
                              @include('global.show_error',['var_name'=>'slip_number'])
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="control-label">Email Address</label>
                              {{ Form::email('email',$model->email,['class'=>'form-control','id'=>'email','placeholder'=>'']) }}
                              @include('global.show_error',['var_name'=>'email'])
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="control-label">Years at Marina</label>
                              {{ Form::text('years_at_marina',$model->years_at_marina,['class'=>'form-control numeric','id'=>'years_at_marina','placeholder'=>'']) }}
                              @include('global.show_error',['var_name'=>'years_at_marina'])
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="control-label">Password</label>
                              {{ Form::password('password',['class'=>'form-control','id'=>'password','placeholder'=>'']) }}
                              @include('global.show_error',['var_name'=>'password'])
                          </div>
                      </div>
                  </div>
                  <!-- <hr> -->
                  <!-- <h4 class="mb-3">VasselVue Camera</h4> -->
                  <!-- <div class="form-row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="control-label">HD Link</label>
                              {{ Form::url('vassel_vue_hd_link',$model->vassel_vue_hd_link,['class'=>'form-control','id'=>'vassel_vue_hd_link','placeholder'=>'']) }}
                              @include('global.show_error',['var_name'=>'vassel_vue_hd_link'])
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="control-label">Normal Link</label>
                              {{ Form::url('vassel_vue_normal_link',$model->vassel_vue_normal_link,['class'=>'form-control','id'=>'vassel_vue_normal_link','placeholder'=>'']) }}
                              @include('global.show_error',['var_name'=>'vassel_vue_normal_link'])
                          </div>
                      </div>
                  </div> -->
              </div>
          </div>
      </div>
  </div>
  <div class="card-footer bg-light text-right">
      <a href="{{ route('admin.user.index') }}" class="btn btn-secondary clear-form">Cancel</a>
      <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
{!! Form::close() !!}

@section('custom_scripts')
    <script>
        $('.numeric').on('input', function (event) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        $(window).on('load', function(){
            var marina_id = $('#marina_id').val();
            dispLisitng(marina_id);
        });

        $( "body" ).on( "change", "#marina_id", function()
        {
            var marina_id = $('#marina_id').val();
            dispLisitng(marina_id);
        });

        function dispLisitng(marina_id)
        {
            var marina_detail_id = {{$marina_detail_id}};
            $.ajax({
                url: "{{ route('admin.user.getdropdowndata') }}",
                type: "GET",
                data: {id:marina_id,marina_detail_id:marina_detail_id},
                success: function(response){
                    $('#slip_number').html(response);
                },
                error: function(value){
                    console.log('error');
                }
            });
        }
    </script>
@endsection
