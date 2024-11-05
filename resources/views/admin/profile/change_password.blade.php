
@extends('admin.layouts.main')
@section('title', config('params.appTitle')."-Change Password" )

@section('main_contant')
<header class="page-header">
  <div class="d-flex align-items-center">
      <div class="mr-auto">
          <h1>Change Password</h1>
      </div>
  </div>
</header>
<section class="page-content container-fluid">
  @include('global.show_session')
  <div class="card">
      {!! Form::open(['route' => ['admin.change_password'],'id'=>'change-password','method'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data']) !!}
          {{ csrf_field() }}
          <div class="card-body">
              <div class="mt-0 mt-md-3">
                  <div class="form-group row">
                      <label class="control-label text-md-right col-md-3">Old Password</label>
                      <div class="col-md-5">
                        {{ Form::password('old_password',['class'=>'form-control','id'=>'oldpassword','placeholder'=>'']) }}
                        {{--@include('global.show_error',['var_name'=>'old_password'])--}}
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="control-label text-md-right col-md-3">New Password</label>
                      <div class="col-md-5">
                        {{ Form::password('password',['class'=>'form-control','id'=>'password','placeholder'=>'']) }}
                        {{--@include('global.show_error',['var_name'=>'password'])--}}
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="control-label text-md-right col-md-3">Confirm Password</label>
                      <div class="col-md-5">
                        {{ Form::password('password_confirmation',['class'=>'form-control','id'=>'password_confirmation']) }}
                         {{--@include('global.show_error',['var_name'=>'password_confirmation'])--}}
                      </div>
                  </div>
              </div>
          </div>
          <div class="card-footer bg-light text-right">
              <a href="{{route('admin.dashboard.index')}}" class="btn btn-secondary clear-form">Cancel</a>
              <button type="submit" class="btn btn-primary">Submit</button>
          </div>
      {!! Form::close() !!}
  </div>
</section>
@endsection
@section('custom_scripts')
<script>


jQuery.validator.addMethod("checkpassword", function (value, element) {
    var result = true;
    var oldpassword=value;
    $.ajax({
        type:"GET",
        async: false,
        url: "{{  route('admin.checkoldpassword') }}",
        data: { oldpassword:oldpassword },
        success: function(data) {
            // alert(data);
            result = (data == 1) ? true : false;
        }
    });
    return result;
}, "Old Password is in correct please try it.");


var form1 = $('#change-password');
var error1 = $('.alert-danger', form1);
var success1 = $('.alert-success', form1);
form1.validate({
  errorElement: 'span', //default input error message container
  errorClass: 'help-block', // default input error message class
  focusInvalid: true, // do not focus the last invalid input
  rules: {
    "old_password":{
      required: true,
      minlength:6,
      checkpassword:true,
    },
    "password":{
      minlength:6,
      required: true,
    },
    "password_confirmation":{
      minlength:6,
      required: true,
      equalTo : "#password",
    },

  },
  messages: {
    "old_password":{
      required: "Old Password filed is required.",
      minlength:"Old password must be at least 6 characters.",
    },
    "password":{
      required: "New password field is required.",
      minlength:"New password must be at least 6 characters.",
    },
    "password_confirmation":{
      equalTo: "Confirm password and New password must match.",
    },
  },
  invalidHandler: function (event, validator) { //display error alert on form submit
    success1.hide();
    error1.show();
  },
  highlight: function (element) { // hightlight error inputs
    $(element)
      .closest('.form-group').addClass('has-error'); // set error class to the control group
    },
  success: function (label) {
      label
          .closest('.form-group').removeClass('has-error'); // set success class
  },
  errorPlacement: function(error, element) {
      $('.error_append').html(error.insertAfter(element));
  },

});

</script>

@endsection
