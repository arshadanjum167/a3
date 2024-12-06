@php
    
  $active = "";
  
@endphp


<aside class="sidebar sidebar-left">
    <div class="sidebar-content">
        <div class="aside-toolbar">
            <ul class="site-logo">
                <li>
                    <a href="{{ route('admin.dashboard.index') }}">
                        <div class="logo">
                            <img src="{{ asset('assets/img/logo.png') }}" style="width:55px" />
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <nav class="main-menu">
            <ul class="nav metismenu">
                <li @if(Request::segment(2)=='dashboard') class="active" @endif><a href="{{ route('admin.dashboard.index') }}"><i class="icon dripicons-meter"></i><span>Dashboard</span></a></li>
                <!-- <li @if(Request::segment(2)=='cmspages') class="active" @endif><a href="{{ route('admin.cmspages.index') }}"><i class="icon dripicons-meter"></i><span>CMS Pages</span></a></li> -->
                <li @if(Request::segment(2)=='project') class="active" @endif><a href="{{ route('admin.project.index') }}"><i class="icon dripicons-briefcase"></i><span>Project</span></a></li>
                <li @if(Request::segment(2)=='testimonial') class="active" @endif><a href="{{ route('admin.testimonial.index') }}"><i class="icon dripicons-bookmark"></i><span>Testimonial</span></a></li>
                <li @if(Request::segment(2)=='casestudy') class="active" @endif><a href="{{ route('admin.case-study.index') }}"><i class="icon dripicons-to-do"></i><span>Casestudy</span></a></li>
                
            </ul>
        </nav>
    </div>
</aside>
