@php

$country_codelist = CommonFunction::getCountryCode();

@endphp

@extends('admin.layouts.main')
@section('title', config('params.appTitle')."-My Profile" )

@section('main_contant')
<header class="page-header">
  <div class="d-flex align-items-center">
      <div class="mr-auto">
          <h1>Edit Profile</h1>
      </div>
  </div>
</header>
<section class="page-content container-fluid">
  <div class="card">
    {!! Form::model($data,['route' =>'admin.edit_profile_form','method'=>'POST','class'=>'','enctype'=>'multipart/form-data']) !!}
                       {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $data['id'] }}">
    <div class="card-body">
        <div class="clearfix">
            <div class="left-form-content pull-left">
                <div class="clearfix">
                    <div class="fileinput text-center fileinput-new" data-provides="fileinput">
                        <div class="btn-file mt-3">
                            <div class="thumbnail fileinput-new uploaded-user-image rounded-circle" style="width: 150px; height: 150px;">
                                <img src="{{ URL::asset($data['profile_image']) }}" alt="">
                            </div>
                            <div class="clearfix"></div>
                            <button class="fileinput-new btn btn-primary2 btn-sm btn-file mt-3"> Browse Image </button>
                            <input type="hidden" value="" name="...">
                            <input type="file" file-model="myFile" name="profile_image" accept="image/x-png,image/gif,image/jpeg">
                            <div class="fileinput-preview fileinput-exists thumbnail uploaded-user-image rounded-circle" style="width: 150px; height: 150px;"></div>
                        </div>
                        <div class="text-center">
                            <button href="javascript:;" class="btn btn-link btn-sm fileinput-exists mt-3" data-dismiss="fileinput"> Remove </button>
                        </div>
                        <div class="clearfix mt-3">
                            <p class="upload-img-label text-muted">*Recommended Size:<br>Minimum 250 * 250</p>
                        </div>
                    </div>
                </div>
                @include('global.show_error',['var_name'=>'profile_image'])
            </div>
            <div class="row">
                <div class="col-xl-8">
                    <div class="form-row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Admin Name</label>
                                {{ Form::text('full_name',$data['full_name'],['class'=>'form-control','id'=>'full_name','placeholder'=>'']) }}
                                @include('global.show_error',['var_name'=>'full_name'])

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <div class="input-group">
                                  {{ Form::select('country_code',$country_codelist,$data['country_code'],['class'=>'form-control select2','id'=>'country_code','style'=>"width: 85px;"]) }}
                                  {{ Form::text('contact_number',$data['contact_number'],['class'=>'form-control border-left-0 ','id'=>'contact_number','maxlength'=>11]) }}
                                </div>
                                @include('global.show_error',['var_name'=>'country_code'])
                                @include('global.show_error',['var_name'=>'contact_number'])
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email Address</label>
                                {{ Form::text('email',$data['email'],['class'=>'form-control','id'=>'email','disabled' => 'disabled']) }}
                                @include('global.show_error',['var_name'=>'email'])
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer bg-light text-right">
        <a href="{{route('admin.show_profile')}}" class="btn btn-secondary clear-form">Cancel</a>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </div>
  {!! Form::close() !!}
</section>
@endsection
