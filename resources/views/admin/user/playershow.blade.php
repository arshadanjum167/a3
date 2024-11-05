@php
if(Session::get('user'))
{
  $backUrl =  Session::get('user');
}
else {
    $backUrl =  route('admin.user.index');
}
$team_data=$model->team;
$result['user_info']['team_data']=array();
if(isset($team_data) && $team_data!=array())
{
$i=0;
$result['user_info']['is_complete_profile']=1;
foreach($team_data as $t)
{
    $result['user_info']['team_data'][$i]['team_id']=$t['team_id'];
    $result['user_info']['team_data'][$i]['team_name']=$t->teamname->name;;
    $result['user_info']['team_data'][$i]['team_image']=\URL::asset('/assets/img/logo.png');
    if(isset($t->teamname->image) && $t->teamname->image!='')
    {
    $result['user_info']['team_data'][$i]['team_image']=$t->teamname->image;
    }

    $result['user_info']['team_data'][$i]['club_id']=$t['club_id'];
    $result['user_info']['team_data'][$i]['club_name']=$t->clubname->name;
    $result['user_info']['team_data'][$i]['club_image']=\URL::asset('/assets/img/logo.png');
    if(isset($t->clubname->image) && $t->clubname->image!='')
    {
    $result['user_info']['team_data'][$i]['club_image']=$t->clubname->image;
    }
    $i++;
}
}
@endphp

@section('title', "View Coach")
@extends('admin.layouts.main')
@section('main_contant')
<header class="page-header">
  <div class="d-flex align-items-center">
      <div class="mr-auto">
          <h1><a href="{{ $backUrl }}"><i class="fa fa-angle-left text-primary" style="vertical-align: 1px;"></i></a> View Player Details</h1>
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
                                <li class="mb-3 col-md-6"><label class="text-muted mb-1">Age</label><br> {{ $model['age']??"" }}</li>
                                <li class="mb-3 col-md-6"><label class="text-muted mb-1">Height</label><br> {{ $model['height']??"" }}</li>
                                <li class="mb-3 col-md-6"><label class="text-muted mb-1">Dominant Foot</label><br> {{ $model['dominant_foot']??"" }}</li>
                                <li class="mb-3 col-md-6"><label class="text-muted mb-1">Position</label><br> {{ $model['position']??"" }}</li>
                                <li class="mb-3 col-md-6"><label class="text-muted mb-1">Jersey Number</label><br> {{ $model['jersey_number']??"" }}</li>
                                <li class="mb-3 col-md-6"><label class="text-muted mb-1">Place of Birth</label><br> {{ $model['place_of_birth']??"" }}</li>

                            </ul>
                            <div class="table-responsive">
                            <table class="table m-0">
                                <tr>
                                <td>Club</td>
                                <td>Team</td>
                                </tr>
                                @php
                                foreach($result['user_info']['team_data'] as $b)
                                {
                                    echo "<tr>";
                                    echo '<td>'.$b['club_name']??''.'</td>';
                                    echo '<td>'.$b['team_name']??''.'</td>';
                                    echo "</tr>";
                                }
                                @endphp
                            </table>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
