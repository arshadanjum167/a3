@extends('admin.layouts.login')
@section('title', 'Forgot Password')
@section('main_contant')

{!! Form::open(['route' =>'admin.forgot_password','method'=>'POST','class'=>'','enctype'=>'multipart/form-data']) !!}
<div class="login-box">
    <div class="login-logo">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" style="width:110px"/>
    </div>
    <div class="login-box-body">
        <h2 class="text-center mb-3">Password Recovery</h2>
        <p class="text-center mb-4">Please enter your registered email address</p>
        @include('global.show_session')
          <div class="form-group">
              {{ Form::text('email',null,['class'=>'form-control','id'=>'email','placeholder'=>'Email']) }}
              @include('global.show_error',['var_name'=>'email'])
          </div>
          <button type="submit" class="btn btn-primary btn-block btn-lg">Submit</button>
    </div>
    <div class="login-box-footer clearfix">
        <div class="form-group text-center">
            Remember Password? <a class="text-primary" href="{{ route('admin.login_form')}}">Login</a>
        </div>
    </div>
</div>
{!! Form::close() !!}

@endsection
