@extends("layouts.app")
@section('content')

<equipment-create :categories="{{ json_encode($categories) }}"
:suppliers="{{ json_encode($suppliers) }}"
:equipment-template-index-url="{{ json_encode(route('equipment-template.index')) }}"
:equipment-template-create-url="{{ json_encode(route('equipment-template.store')) }}"
:category-create-url="{{ json_encode(route('category.store')) }}"></equipment-create>

@endsection