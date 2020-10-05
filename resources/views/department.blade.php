@extends("layouts.app")
@section('content')

<department-index 
:departments="{{json_encode($departments)}}"></department-index>

@endsection