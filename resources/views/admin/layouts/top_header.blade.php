@php
$email=$first_name='';
$profile_pic = URL::asset('/assets/img/no-image.png');
if(Auth::guard('admin')->check())
{
  if(Auth::guard('admin')->user()->email)
    $email = Auth::guard('admin')->user()->email;
  if(Auth::guard('admin')->user()->full_name)
    $full_name = Auth::guard('admin')->user()->full_name;
  if(Auth::guard('admin')->user()->profile_image)
    $profile_pic = Auth::guard('admin')->user()->profile_image;
}

//$notification_list = CommonFunction::AdminNotification(Auth::guard('admin')->user()->id);

@endphp

<!-- TOP TOOLBAR WRAPPER -->
<nav class="top-toolbar navbar navbar-mobile navbar-tablet">
    <ul class="navbar-nav nav-left">
        <li class="nav-item">
            <a href="javascript:void(0)" data-toggle-state="aside-left-open">
            <i class="icon dripicons-align-left"></i>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav nav-center site-logo">
        <li>
            <a href="#">
                <span class="brand-text">{{  config('params.appTitle') }}</span>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav nav-right">
        <li class="nav-item">
            <a href="javascript:void(0)" data-toggle-state="mobile-topbar-toggle">
            <i class="icon dripicons-dots-3 rotate-90"></i>
            </a>
        </li>
    </ul>
</nav>
<nav class="top-toolbar navbar navbar-desktop flex-nowrap">
    <ul class="navbar-nav nav-right">
        

        <li class="nav-item dropdown mr-3">
            <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img src="{{ $profile_pic }}" class="w-35 h-35 rounded-circle" alt="Admin">
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-accout">
                <div class="dropdown-header pb-3">
                    <div class="media d-user">
                        <img class="align-self-center mr-3 w-40 h-40 rounded-circle" src="{{ $profile_pic }}" alt="Admin">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0">{{ $full_name }}</h5>
                            <span>{{$email}}</span>
                        </div>
                    </div>
                </div>

                <a class="dropdown-item" href="{{ route('admin.show_profile') }}"><i class="icon dripicons-user"></i> My Profile</a>
                <a class="dropdown-item" href="{{ route('admin.show_change_password_form')  }}"><i class="icon dripicons-gear"></i> Change Password</a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
                            {{ csrf_field() }}
                    <button class="dropdown-item pointer" type="submit"><i class="icon dripicons-lock"></i> Logout</button>
                </form>

            </div>
        </li>
    </ul>

</nav>
<!-- END TOP TOOLBAR WRAPPER -->
