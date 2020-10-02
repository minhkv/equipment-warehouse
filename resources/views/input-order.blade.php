@extends('layouts.app')
@section('content')
<input-order
    :orders="{{ json_encode($orders) }}"
    :order-create-url="{{ json_encode(route('input-order.create')) }}"
    :order-index-url="{{ json_encode(route('input-order.index')) }}"
    ></input-order>
@endsection