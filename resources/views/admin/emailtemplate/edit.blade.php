@php
$title = 'Edit Email Template';
@endphp

@extends('admin.layouts.main')

@section('title', $title)

@section('main_contant')

<div class="content">
    <header class="page-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h1>{{ $title }}</h1>
            </div>
        </div>
    </header>

    <section class="page-content container-fluid">
        <div class="card">
          @include('admin.emailtemplate._form',
          ['model'=>$model,
           'method'=>'PUT',
           'route' => 'admin.emailtemplates.update'
          ])
        </div>
    </section>
</div>

@endsection
