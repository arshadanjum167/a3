@php
$title = 'Edit Casestudy';
@endphp
@extends('admin.layouts.main')

@section('title', config('params.appTitle') )

@section('main_contant')

<div class="content">
    <header class="page-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h1>Add Case-study</h1>
            </div>
        </div>
    </header>

    <section class="page-content container-fluid">
        <div class="card">
          @include('admin.casestudy._form',
          ['model'=>$model,
           'method'=>'POST',
           'route' => 'admin.case-study.store'
          ])
        </div>
    </section>
</div>

@endsection


