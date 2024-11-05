@extends('web.layouts.login')
@section('title', config('params.appTitle') )
@section('main_contant')

{!! Form::open(['route' =>'reset_password','method'=>'POST','class'=>'','enctype'=>'multipart/form-data']) !!}
<div class="login-box">
    <div class="login-logo">
        <h1 class="text-light m-0 py-2">{{  config('params.appTitle') }}</h1>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <h2 class="text-center mb-3">Reset Password</h2>
        <p class="text-center mb-4"></p>

        {{ Form::hidden('reset_token', $token) }}

        @include('global.show_session')
          <div class="form-group">
            {{ Form::password('password',['class'=>'form-control','id'=>'password','placeholder'=>'Password']) }}
            @include('global.show_error',['var_name'=>'password'])
          </div>
          <div class="form-group">
            {{ Form::password('password_confirmation',['class'=>'form-control','id'=>'password_confirmation','placeholder'=>'Confirm Password']) }}
            @include('global.show_error',['var_name'=>'password_confirmation'])
          </div>
          <button type="submit" class="btn btn-primary btn-block btn-lg">Submit</button>
    </div>
    <div class="login-box-footer clearfix">

    </div>
</div>
{!! Form::close() !!}

@endsection
