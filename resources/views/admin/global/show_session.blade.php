@if(Session::has('message'))
    {!! Session::get('message') !!}
    {!! Session::flash('message',''); !!}
@endif
