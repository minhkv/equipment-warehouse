@extends("layouts.app")
@section('content')

<category :categories="{{ json_encode($categories) }}"
:category-index-url="{{ json_encode(route('category.index')) }}"
:category-create-url="{{ json_encode(route('category.store')) }}"></category>

@endsection