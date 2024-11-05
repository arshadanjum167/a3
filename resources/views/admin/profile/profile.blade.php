@extends('admin.layouts.main')
@section('title', config('params.appTitle')."-My Profile" )

@section('main_contant')

<header class="page-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h1>My Profile</h1>
        </div>
        <div class="m-l-10">
          <a href="{{ url('/admin/edit-profile') }}" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>
</header>
<section class="page-content container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="media d-user align-items-start">
                <img src="{{ URL::asset($data['profile_image']) }}" class="mr-4 ml-3 rounded-circle img-thumbnail o-cover" alt="profile-image" style="width: 130px; height: 130px;">
                <div class="media-body">
                    <div class="row">
                        <div class="col-lg-12  col-xl-10">
                            <h2 class="mt-0 mb-3 text-info">{{ $data['full_name'] }}</h2>
                            <ul class="list-unstyled text-left row mb-0">
                                <li class="mb-3 col-md-6"><label class="text-muted mb-1">Email Address</label><br> {{ $data['email'] }}</li>
                                <li class="mb-3 col-md-6"><label class="text-muted mb-1">Mobile Number</label><br> {{ $data['country_code'].' '.$data['contact_number'] }} </li>
                                <!-- <li class="mb-3 col-md-6"><label class="text-muted mb-1">Address</label><br> {{ $data['address']??"" }}</li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
