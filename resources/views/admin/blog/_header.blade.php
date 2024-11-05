
<?php

?>
<header class="page-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h1>{{ $title }}</h1>
        </div>
        {!! Form::open(['route' =>['admin.blog.index'],'class'=>'d-flex align-items-centers','method'=>'GET']) !!}
        

        <div class="m-l-10">
            <div class="input-group" style="width: 220px;">
                <input type="text" name="search"  value="{{ $search }}" class="form-control" placeholder="Search here . . .">
                <div class="input-group-append">
                    <button type="submit" class="input-group-text pointer"><span class="icon dripicons-search"></span></button>
                </div>
            </div>
        </div>
        {!! Form::close() !!} 
         <div class="m-l-10">
            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary "> Add Blog</a>
        </div> 
    </div>
</header>
    