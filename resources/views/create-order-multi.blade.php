@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('css/create-order.css')}}">
<link rel="stylesheet" href="{{asset('css/create-order-multi.css')}}">
<link rel="stylesheet" href="{{asset('css/order-detail.css')}}">
<multi-step-form></multi-step-form>
@endsection