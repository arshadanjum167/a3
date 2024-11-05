@php
  Session::put('cms',Request::fullUrl());
@endphp
@section('title', "Cms Pages")
@extends('admin.layouts.main')
@section('main_contant')
<header class="page-header">
<div class="d-flex align-items-center">
    <div class="mr-auto">
        <h1> Manage CMS </h1>
    </div>
</div>
</header>
<section class="page-content container-fluid">
  @include('global.show_session')
  <div class="card">
    <div class="card-body p-0 example">
      <div class="table-responsive">
        <table class="table m-0">
          <thead>
            <tr>
              <th>Particular Name</th>
              <th>Last Modified on</th>
              <th class="text-center" style="width:120px;">Actions</th>
            </tr>
          </thead>
        <tbody>
          @if(isset($model) && $model != array())
            @foreach($model as $data)
            <tr>
              <td>{{ $data->name??"" }}</td>
              <td>{{ isset($data->u_date)?date('dS F, Y',strtotime($data->u_date)):"" }}</td>
              <td class="table-field-actions text-center">
                  <a href="{{ route('admin.cmspages.show',['id'=>$data->id]) }}" class="btn btn-default btn-icon-only" title="">
                      <i class="zmdi zmdi-eye zmdi-hc-lg text-secondary"></i>
                  </a>
              </td>
          </tr>
            @endforeach
          @else
          <tr>
            <p>No Data Found</p>
          </tr>
          @endif
        </tbody>
        </table>
      </div>
    <div class="p-3">
      <div class="row">
        <div class="col-sm-12 col-md-5">
          <div class="mt-1" id="bs4-table_info" role="status" aria-live="polite">Showing {{ $model->firstItem()??0 }} to {{ $model->lastItem()??0 }} of {{ $model->total() }} entries</div>
        </div>
        <div class="col-sm-12 col-md-7">
    				<div class="text-right">
      					{{ $model->links('vendor.pagination.default') }}
    				</div>
				 </div>
      </div>
    </div>
    </div>
  </div>
</section>
@endsection
