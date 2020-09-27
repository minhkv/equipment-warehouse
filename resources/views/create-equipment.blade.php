@extends("layouts.app")
@section('content')

<test :categories="{{ json_encode($categories) }}"
:equipment-template-index-url="{{ json_encode(route('equipment-template.index')) }}"
:equipment-template-create-url="{{ json_encode(route('equipment-template.store')) }}"
:category-create-url="{{ json_encode(route('category.store')) }}"></test>

@endsection