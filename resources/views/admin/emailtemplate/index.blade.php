@php
  $title = 'Email Templates';
//   $search=$active_value=$active=$inactive='';
  // $name='title';
  // $sort='DESC';
  // $sort_link='';

//   if(Request::has('search') && Request::get('search') !=null ){
//     $search=Request::get('search');
//   }

  // if(Request::has('name') && Request::get('name') !=null ){
  //   $name=Request::get('name');
  // }

  // if(Request::has('sort') && Request::get('sort') !=null ){
  //   $sort=$sort_link=Request::get('sort');
  //   $sort=$sort=='ASC'?'DESC':'ASC';
  // }

//   if(Request::has('is_active') && Request::get('is_active') !=null){
//     $active_value=Request::get('is_active');

//     if(Request::get('is_active')){
//       $active='selected';
//     }
//     else{
//       $inactive='selected';
//     }
//   }
//   $arr = ['search' => $search , 'is_active'=>$active_value ,'name'=>$name,'sort'=>$sort ];
// $arr = ['name'=>$name,'sort'=>$sort ];
// $arr_links = ['search' => $search , 'is_active'=>$active_value ,'name'=>$name,'sort'=>$sort_link ];
// $arr_links = ['name'=>$name,'sort'=>$sort_link ];
@endphp


@extends('admin.layouts.main')
@section('title', $title)
@section('main_contant')

<div class="content">
    @include('admin.emailtemplate._header')
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
                                        <th class="sortable">Email Subject</th>
                                        {{-- <th class="text-center" style="width:115px;">Status</th> --}}
                                        <th class="text-center" style="width:120px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @if(isset($data) && $data != array())
                                    @foreach($data as $value)
                                    <tr>
                                        <td>{{$value->title}}</td>
                                        {{-- <td class="text-center">
                                            @if($value->is_active==1)
                                              <a href="javascript:void(0)" onclick="status_chage(0,{{ $value->id}})" > <small class="label label-success">Active</small></a>
                                            @else
                                              <a href="javascript:void(0)" onclick="status_chage(1,{{ $value->id}})" > <small class="label label-danger">In Active</small></a>
                                            @endif
                                        </td> --}}
                                        <td class="table-field-actions text-center">
                                            <div class="btn-group">
                                                <a href="#" data-toggle="dropdown" class="btn btn-default btn-sm btn-icon-only transparent" title="">
                                                    <i class="icon dripicons-dots-3 zmdi-hc-fw"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-icon-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('admin.emailtemplates.edit',['id'=>$value->id]) }}"><i class="zmdi zmdi-edit zmdi-hc-fw text-secondary"></i> Edit</a>
                                                    {{ Form::open(array('route' =>['admin.emailtemplates.destroy',$value->id])) }}
                                                    {{-- {{ Form::hidden('_method', 'DELETE') }} --}}
                                                    <!-- <button type="submit" class="btn btn-block btn-submit" >Remove</button> -->
                                                    {{-- <button class="dropdown-item btn-delete pointer" type="submit"><i class="zmdi zmdi-delete zmdi-hc-fw text-secondary"></i> Delete</button> --}}
                                                    {{-- {{ Form::close() }} --}}
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
  {{-- @include('global.active_inactive',['route'=>'admin.emailtemplate.status_change']) --}}
@endsection
