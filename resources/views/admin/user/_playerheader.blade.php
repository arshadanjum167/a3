{!! Form::open(['route' =>['admin.user.player'],'id'=>'user','method'=>'GET']) !!}
<header class="page-header">
  <div class="d-flex align-items-center">
      <div class="mr-auto">
          <h1> Player</h1>
      </div>
         <div class="m-l-10">
          <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Search by Full name, Email id, Mobile Number, Slip Number, Marina Name" title="Search by Full name, Email id, Mobile Number" style="width: 230px;">
      </div>
         <div class="m-l-10">
          <button type="submit" class="btn btn-primary2">
              Submit
          </button>
      </div>
      <div class="m-l-10">
          <a href="{{ route('admin.user.player') }}" class="btn btn-secondary">Reset</a>
      </div>
       <!-- <div class="m-l-10">
         <a href="{{ route('admin.user.create') }}" class="btn btn-primary">Add New </a>
       </div> -->
  </div>
</header>
{!! Form::close() !!}
