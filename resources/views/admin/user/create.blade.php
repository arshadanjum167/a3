@extends('admin.layouts.main')

@section('title','Add User')

@section('main_contant')
<header class="page-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h1>Add User</h1>
        </div>
    </div>
</header>
<section class="page-content container-fluid">
    <div class="card">
        @include('admin.user._form',
          ['model'=>$model,
           'method'=>'POST',
           'route' => 'admin.user.store'
          ])
    </div>
</section>
@endsection

