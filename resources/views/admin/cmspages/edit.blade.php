
@extends('admin.layouts.main')

@section('title', "Edit Subscription Plan")

@section('main_contant')

<div class="content">
    <header class="page-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h1>Edit {{ $model->name??"" }}</h1>
            </div>
        </div>
    </header>

    <section class="page-content container-fluid">
        <div class="card">
          @include('admin.cmspages._form',
          ['model'=>$model,
           'method'=>'PUT',
           'route' => 'admin.cmspages.update'
          ])
        </div>
    </section>
</div>
@endsection
@section('custom_scripts')
<script src="{{asset('/assets/vendor/ckeditor/ckeditor.js') }}"></script>
<script>

   CKEDITOR.replace( 'editor1' );
</script>
@endsection
