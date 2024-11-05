@php
if(Session::get('cms'))
    {
      $backUrl =  Session::get('cms');
    }
    else {
        $backUrl =  route('admin.cmspages.index');
    }
@endphp
@section('title', "Cms Pages")
@extends('admin.layouts.main')
@section('main_contant')
<header class="page-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h1><a href="{{ $backUrl }}"><i class="fa fa-angle-left text-primary" style="vertical-align: 1px;"></i></a> View {{ $model->name??"" }}</h1>
        </div>
        <div class="m-l-10">
            <a href="{{ route('admin.cmspages.edit',['id'=>$model->id]) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</header>
<section class="page-content container-fluid">
    <div class="card">
        <div class="card-body">
            <p>{!!$model->description ?? ""!!}</p>
        </div>
    </div>
</section>
@endsection
