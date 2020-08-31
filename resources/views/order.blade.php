@extends('layouts.app')
@section('content')
<order
    :orders="{{ json_encode($orders) }}"
    :order-create-url="{{ json_encode(route('order.create')) }}"
    :order-index-url="{{ json_encode(route('order.index')) }}"
    ></order>
@endsection