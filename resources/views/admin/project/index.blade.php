@php
  $title = 'Project';
  $search=$active_value=$active=$inactive='';
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

@endphp


@extends('admin.layouts.main')
@section('title', $title)
@section('main_contant')

<div class="content">
    @include('admin.project._header')
    <section class="page-content container-fluid">
        @include('global.show_session')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                        <div class="card-body p-0">
                          <div class="table-responsive">
                            <table class="table m-0" id="example1">
                                <thead>
                                    <tr>
                                        <th class="sortable">Title</th>
                                        <th class="sortable">Address</th>
                                        <th class="sortable">Favourite</th>
                                        <th class="text-center" style="width:115px;">Status</th>
                                        <th class="text-center" style="width:120px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @if(isset($data) && $data != array())
                                    @foreach($data as $value)
                                    <tr>
                                        <td>{{$value->title}}</td>
                                        <td>{{$value->address}}</td>
                                        <td class="text-center">
                                            @if($value->is_favourite==1)
                                              <a href="javascript:void(0)" onclick="update_favourite(0,{{ $value->id}})" > <small class="label label-success">Yes</small></a>
                                            @else
                                              <a href="javascript:void(0)" onclick="update_favourite(1,{{ $value->id}})" > <small class="label label-danger">No</small></a>
                                            @endif
                                        </td> 
                                        <td class="text-center">
                                            @if($value->is_active==1)
                                              <a href="javascript:void(0)" onclick="status_change(0,{{ $value->id}})" > <small class="label label-success">Active</small></a>
                                            @else
                                              <a href="javascript:void(0)" onclick="status_change(1,{{ $value->id}})" > <small class="label label-danger">In Active</small></a>
                                            @endif
                                        </td> 
                                        <td class="table-field-actions text-center">
                                            <div class="btn-group">
                                                <a href="#" data-toggle="dropdown" class="btn btn-default btn-sm btn-icon-only transparent" title="">
                                                    <i class="icon dripicons-dots-3 zmdi-hc-fw"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-icon-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('admin.project.edit',['id'=>$value->id]) }}"><i class="zmdi zmdi-edit zmdi-hc-fw text-secondary"></i> Edit</a>
                                                    {{ Form::open(array('route' =>['admin.project.destroy',$value->id])) }}
                                                     {{ Form::hidden('_method', 'DELETE') }} 
                                                    <button type="submit" class="dropdown-item btn-delete pointer" ><i class="zmdi zmdi-delete zmdi-hc-fw text-secondary"></i> Delete</button>
                                                    {{-- <button class="dropdown-item btn-delete pointer" type="submit"><i class="zmdi zmdi-delete zmdi-hc-fw text-secondary"></i> Delete</button> --}}
                                                     {{ Form::close() }} 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                  @else
                                  <tr>
                                    <td>
                                      <p>No records found</p>
                                    </td>
                                  </tr>
                                  @endif
                                </tbody>
                            </table>
                          </div>
                          <div class="p-3">
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="mt-1" id="bs4-table_info" role="status" aria-live="polite">Showing {{ $data->firstItem()??0 }} to {{ $data->lastItem()??0 }} of {{ $data->total() }} entries</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="text-right">
                                        <div class="float-right">
                                            {{ $data->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('custom_scripts')
  @include('global.delete_confirmation')
  @include('global.active_inactive',['route'=>'admin.project.status_change','fav_route'=>'admin.project.update_favourite']) 
@endsection
