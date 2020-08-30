@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('css/create-order.css')}}">
<link rel="stylesheet" href="{{asset('css/create-order-multi.css')}}">
<link rel="stylesheet" href="{{asset('css/order-detail.css')}}">
<multi-step-form></multi-step-form>
<script>
    Vue.component('multi-step-form',require('../components/multi-step-form.vue').default);
    var app = new Vue({
        el: '#app'
    });
</script>
@endsection