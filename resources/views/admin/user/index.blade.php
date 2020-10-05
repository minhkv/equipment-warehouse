@extends('layouts.app')

@section('content')
<user-index 
:users="{{ json_encode($users) }}"
:roles="{{ json_encode($roles) }}"
:user-index-url="{{ json_encode(route('user.index')) }}"></user-index>
@endsection
