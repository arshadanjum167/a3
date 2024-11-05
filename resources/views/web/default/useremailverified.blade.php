{{--@extends('admin.layouts.login')--}}
@extends('web.layouts.login')

{{--@section('main_contant')--}}
@section('main_contant')
<div class="login-box">
    <div class="login-logo">
        <h1 class="text-light m-0 py-2">{{  config('params.appTitle') }}</h1>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="text-center mb-4">
          {{--@include('global.show_session')--}}
          @if (Session::has('flash_msg'))
            {!! Session::get('flash_msg') !!}
          @endif
        </p>
    </div>
    
</div>
                
@endsection