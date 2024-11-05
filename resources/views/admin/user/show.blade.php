@php
if(Session::get('user'))
{
  $backUrl =  Session::get('user');
}
else {
    $backUrl =  route('admin.user.player');
}
$team_data=$model->team;
$club_name=$team_data[0]->clubname->name??'';
@endphp

@section('title', "View Coach")
@extends('admin.layouts.main')
@section('main_contant')
<header class="page-header">
  <div class="d-flex align-items-center">
      <div class="mr-auto">
          <h1><a href="{{ $backUrl }}"><i class="fa fa-angle-left text-primary" style="vertical-align: 1px;"></i></a> View Coach Details</h1>
      </div>
    </div>
</header>
<section class="page-content container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="media d-user align-items-start">
                <img src="{{ URL::asset($model['profile_image']) }}" class="mr-4 ml-3 rounded-circle img-thumbnail o-cover" alt="profile-image" style="width: 130px; height: 130px;">
                <div class="media-body">
                    <div class="row">
                        <div class="col-lg-12  col-xl-10">
                            <h2 class="mt-0 mb-3 text-info">{{ $model['full_name'] }}</h2>
                            <ul class="list-unstyled text-left row mb-0">
                                <li class="mb-3 col-md-6"><label class="text-muted mb-1">Email Address</label><br> {{ $model['email'] }}</li>
                                <li class="mb-3 col-md-6"><label class="text-muted mb-1">Mobile Number</label><br> {{ $model['country_code'].' '.$model['contact_number'] }} </li>
                                <li class="mb-3 col-md-6"><label class="text-muted mb-1">Licence</label><br> {{ $model['licence']??"" }}</li>
                                <li class="mb-3 col-md-6"><label class="text-muted mb-1">Year of Coaching</label><br> {{ $model['year_of_coaching']??"" }}</li>
                                <li class="mb-3 col-md-6"><label class="text-muted mb-1">Language</label><br> {{ $model['language']??"" }}</li>
                                <li class="mb-3 col-md-6"><label class="text-muted mb-1">Club</label><br> {{ $club_name??"" }}</li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
