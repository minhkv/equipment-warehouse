@extends("layouts.app")
@section('content')

<create-input-order
:categories="{{ json_encode($categories) }}"
:suppliers="{{ json_encode($suppliers) }}"
:templates="{{ json_encode($equipmentTemplates) }}"
:template-create-url="{{ json_encode(route('equipment-template.store')) }}"
:store-input-order-url="{{ json_encode(route('input-order.store')) }}"
:input-order-index-url="{{ json_encode(route('input-order.index')) }}"
:stocker_id="{{ json_encode($stocker_id) }}"></create-input-order>

@endsection