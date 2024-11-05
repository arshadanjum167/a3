@extends('admin.layouts.login')
@section('title', 'Acknowledgement')
@section('main_contant')

<div class="login-box">
    <div class="login-logo">
        <h1 class="text-light m-0 py-2">{{  config('params.appTitle') }}</h1>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="text-center mb-4">
          @include('global.show_session')
        </p>
    </div>
    
</div>

@endsection
