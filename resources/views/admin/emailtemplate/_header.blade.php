<header class="page-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h1>{{ $title }}</h1>
        </div>
        {{-- {!! Form::open(['route' =>['admin.emailtemplates.index'],'class'=>'d-flex align-items-centers','method'=>'GET']) !!}
        <div class="m-l-10">
            <select class="form-control" name="is_active" style="width: 130px;">
                <option value="">-- Status --</option>
                <option value="1" {{ $active }} >Active</option>
                <option value="0" {{ $inactive }} >Inactive</option>
            </select>
        </div>

        <div class="m-l-10">
            <div class="input-group" style="width: 220px;">
                <input type="text" name="search"  value="{{ $search }}" class="form-control" placeholder="Search here . . .">
                <div class="input-group-append">
                    <button type="submit" class="input-group-text pointer"><span class="icon dripicons-search"></span></button>
                </div>
            </div>
        </div>
        {!! Form::close() !!} --}}
        {{-- <div class="m-l-10">
            <a href="{{ route('admin.emailtemplates.create') }}" class="btn btn-primary "> Add Email Template</a>
        </div> --}}
    </div>
</header>
    