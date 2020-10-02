@extends('layouts.app')
@section('content')
<order-detail 
    :categories="{{ json_encode($categories) }}"
    :equipment-templates="{{ json_encode($equipmentTemplates) }}"
    :order="{{ json_encode($order) }}"
    :order-index-url="{{ json_encode(route('order.index')) }}"
    :accept-url="{{ json_encode(route('order-request.accept', $order)) }}"
    :reject-url="{{ json_encode(route('order-request.reject', $order)) }}"
    :equipment-output-url="{{ json_encode(route('order-request.output', $order)) }}"
    :equipment-return-url="{{ json_encode(route('order-request.return', $order)) }}"
    :complete-url="{{ json_encode(route('order-request.complete', $order)) }}"
    :back-url="{{ json_encode(route('order-request.back', $order)) }}"
    :order-create-url="{{ json_encode(route('order.create')) }}"
    ></order-detail>
@endsection