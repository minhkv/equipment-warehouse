@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('css/create-order.css')}}">
<link rel="stylesheet" href="{{asset('css/create-order-multi.css')}}">
<link rel="stylesheet" href="{{asset('css/order-detail.css')}}">
<multi-step-form
    :order-index-url="{{ json_encode(route('order.index')) }}"
    :templates="{{ json_encode($equipmentTemplates) }}"
    :categories="{{ json_encode($categories) }}"
    :channels="{{ json_encode($channels) }}"
    :type="1"
    :stocker-id="{{ json_encode($stocker_id) }}"
    :order-create-url="{{ json_encode(route('order-request.store')) }}"
></multi-step-form>

@endsection