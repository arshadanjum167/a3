@extends('admin.layouts.login')
@section('title', 'Login')
@section('main_contant')

{!! Form::open(['route' =>'admin.login','method'=>'POST','class'=>'','enctype'=>'multipart/form-data']) !!}
<div class="login-box">
    <div class="login-logo">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" style="width:110px" />
        <!--<h2 class="text-white m-0 p-0">Workernet</h2>-->
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <h2 class="text-center mb-3">Login</h2>
        <p class="text-center mb-4">Enter your credentials to access the panel</p>
            @include('global.show_session')
            <div class="form-group">
                {{ Form::text('email',$user_data['email'],['class'=>'form-control','id'=>'email','placeholder'=>'Email Id']) }}
                @include('global.show_error',['var_name'=>'email'])
            </div>
            <div class="form-group">
              <input id="password" type="password" class="form-control" name="password" value="{{ $user_data['password'] }}" placeholder="Password">
              @include('global.show_error',['var_name'=>'password'])

            </div>
            <button type="submit" class="btn btn-primary btn-block btn-lg">Login</button>

    </div>
    <div class="login-box-footer clearfix">
        <div class="password-reset-link pull-right">
            <a class="text-primary" href="{{ route('admin.show_forgot_form') }}"> Forgot Password?</a>
        </div>
        <div class="form-group pull-left">
            <div class="custom-control custom-checkbox checkbox-primary mb-0">
                <input type="checkbox" class="custom-control-input" value="1" name="remember_me" id="customCheck2" {{ ( ! empty($user_data['email']) ? 'checked' : '' ) }}>
                <label class="custom-control-label" for="customCheck2">Remember Me</label>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

@endsection
