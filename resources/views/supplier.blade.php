@extends('layouts.app')
@section('content')
<supplier 
    :suppliers="{{json_encode($suppliers)}}"
    :supplier-index-url="{{ json_encode(route('supplier.index')) }}"
    :store-supplier-url="{{ json_encode(route('supplier.store')) }}"
></supplier>
@endsection