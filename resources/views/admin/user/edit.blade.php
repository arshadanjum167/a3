@extends('admin.layouts.main')

@section('title','Update User')

@section('main_contant')
<header class="page-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h1>Update User</h1>
        </div>
    </div>
</header>
<section class="page-content container-fluid">
    <div class="card">
        @include('admin.user._form',
          ['model'=>$model,
           'method'=>'PUT',
           'route' => 'admin.user.update'
          ])
    </div>
</section>
@endsection
@section('custom_scripts')
<script>
$('.numeric').on('input', function (event) {
    this.value = this.value.replace(/[^0-9]/g, '');
});
</script>
@endsection
