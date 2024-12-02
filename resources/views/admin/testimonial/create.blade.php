@php
$title = 'Edit Testimonial';
@endphp
@extends('admin.layouts.main')

@section('title', config('params.appTitle') )

@section('main_contant')

<div class="content">
    <header class="page-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h1>Add Testimonial</h1>
            </div>
        </div>
    </header>

    <section class="page-content container-fluid">
        <div class="card">
          @include('admin.testimonial._form',
          ['model'=>$model,
           'method'=>'POST',
           'route' => 'admin.testimonial.store'
          ])
        </div>
    </section>
</div>

@endsection


