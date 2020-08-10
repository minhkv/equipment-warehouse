@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/order-detail.css" >
<div class="container">
    <article class="card">
        
        <div class="card-body">
            <!-- <div class="row"> -->
                <a href="{{ route('order') }}" class="btn btn-light mb-3" data-abc="true"> <i class="fa fa-chevron-left"></i> Quay lại</a>
            <!-- </div> -->
            <h6>Đơn mượn: CM0001 <span class="badge badge-primary">Đang tiến hành</span></h6>
            <article class="card">
                <div class="card-body row">
                    <div class="col"> <strong><i class="fa fa-user"></i> Người mượn:</strong> <br>Minh </div>
                    <div class="col"> <strong>Lý do:</strong> <br> Quay chương trình tụng kinh quanh chùa </div>
                    <div class="col"> <strong><i class="fa fa-calendar"></i> Thời hạn:</strong> <br> 15/08/2020 </div>
                    <div class="col"> <strong>Ghi chú:</strong> <br>  </div>
                </div>
            </article>
            <x-order-step current="2" />
        </div>
    </article>
</div>
@endsection