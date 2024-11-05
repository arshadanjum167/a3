@php
  $status = CommonFunction::getStatus();
  $search='';
  $full_name = 'full_name';
  $email = 'email';
  $i_date = 'i_date';
  $last_login = 'last_login';
  $sort_link='';
  $sort='DESC';
  $sort_val = "descending";


  if(Request::has('search') && Request::get('search') !=null ){
    $search=Request::get('search');
  }

  if(Request::has('sort') && Request::get('sort') !=null ){
    $sort=$sort_link=Request::get('sort');
    $sort=$sort=='ASC'?'DESC':'ASC';
    $sort_val=$sort=='ASC'?'descending':'ascending';
  }

  if(Request::has('search') && Request::get('search') !=null ){
    $search=Request::get('search');
  }
  $arr_full_name = ['search' => $search ,'full_name'=>$full_name,'sort'=>$sort];
  $arr_email = ['search' => $search ,'email'=>$email,'sort'=>$sort];
  $arr_i_date = ['search' => $search ,'i_date'=>$i_date,'sort'=>$sort];
  $arr_last_login = ['search' => $search ,'last_login'=>$last_login,'sort'=>$sort];
  $arr_links = ['search' => $search,'sort'=>$sort_link];

  Session::put('user',Request::fullUrl());
@endphp

@section('title', "Coach")
@extends('admin.layouts.main')
@section('main_contant')
@include('admin.user._header')
<section class="page-content container-fluid">
  @include('global.show_session')
  <div class="card">
    <div class="card-body p-0 example">
      <div class="table-responsive">
        <table class="table m-0">
          <thead>
            <tr>
            <th class="sortable {{ $sort_val }}"><a href="{{ route('admin.user.index',$arr_full_name)}}">Full Name</a></th>
            <th class="sortable {{ $sort_val }}"><a href="{{ route('admin.user.index',$arr_email)}}">Email Address</a></th>
            <th>Mobile Number</th>
            <th class="sortable {{ $sort_val }}"><a href="{{ route('admin.user.index',$arr_i_date)}}">Registered Date</a></th>
            
            
            <th style="width:100px;">Status</th>
            <th class="text-center" style="width:120px;">Actions</th>
        </tr>
				    </thead>
        <tbody>
          @if(isset($model) && $model != array())
            @foreach($model as $data)
              <tr>
  					    <td>{{ $data->full_name??"" }}</td>
  					    <td>{{ $data->email??"" }}</td>
  					    <td class="nowrap">{{ $data->country_code .' '.$data->contact_number }}</td>
  					    <td>{{ isset($data->i_date)?date(config('params.date_format'),strtotime($data->i_date)):"" }}</td>
  					   
  					    <td class="table-field-status text-left">
      						<div class="btn-group show m-l-0 p-0">
                      @if($data->is_active == 1)
      						          <a href="#" data-toggle="dropdown" class="label label-success" aria-expanded="false">{{ isset($status[$data->is_active])?$status[$data->is_active]:"-" }}<span class="la la-caret-down"></span></a>
                      @else
                        <a href="#" data-toggle="dropdown" class="label label-danger" aria-expanded="false">{{ isset($status[$data->is_active])?$status[$data->is_active]:"-" }}<span class="la la-caret-down"></span></a>
                      @endif
      						    <div class="dropdown-menu dropdown-icon-menu dropdown-menu-right">
          							<a href="javascript:void(0)" class="dropdown-item" onclick="status_change(1,{{ $data->id}})"><small><i class="fa fa-circle fa-fw text-success"></i></small> Active</a>
          							<a href="javascript:void(0)" class="dropdown-item" onclick="status_change(0,{{ $data->id}})"><small><i class="fa fa-circle fa-fw text-danger"></i></small> Inactive</a>
      						    </div>
      						</div>
  					    </td>
  					    <td class="table-field-actions text-center">
      						<div class="btn-group">
      						    <a href="#" data-toggle="dropdown" class="btn btn-default btn-sm btn-icon-only transparent" title=""><i class="icon dripicons-dots-3 zmdi-hc-fw"></i></a>
      						    <div class="dropdown-menu dropdown-icon-menu dropdown-menu-right">
          							<a class="dropdown-item" href="{{ route('admin.user.show',['id'=>$data->id]) }}"><i class="zmdi zmdi-eye zmdi-hc-fw text-secondary"></i> View</a>
          							<!-- <a class="dropdown-item" href="{{ route('admin.user.edit',['id'=>$data->id]) }}"><i class="zmdi zmdi-edit zmdi-hc-fw text-secondary"></i> Edit</a> -->
                        {{ Form::open(array('route' =>['admin.user.destroy',$data->id],'id'=>"destroy".$data->id)) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                            <button class="dropdown-item btn-delete" type="submit"><i class="zmdi zmdi-delete zmdi-hc-fw text-secondary"></i> Delete</button>
                        {{ Form::close() }}
      						    </div>
      						</div>
  					    </td>
  					</tr>
            @endforeach
          @else
          <tr>
            <td><p>No Data Found</p></td>
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
      					{{ $model->appends($arr_links)->links('vendor.pagination.default') }}
    				</div>
				 </div>
      </div>
    </div>
    </div>
  </div>
</section>
@endsection
@section('custom_scripts')
@include('global.delete_confirmation')
@include('global.active_inactive',['route'=>'admin.user.status_change'])
@endsection
