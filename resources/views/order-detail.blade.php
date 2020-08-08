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
            <div class="track">
                <div class="step active"> 
                    <span class="icon"> <i class="fa fa-file"></i> </span> 
                    <span class="text">Tạo đơn hàng</span> 
                    <span class="text-muted">20/07/2020 5:00:00</span> 
                </div>
                <div class="step active"> 
                    <span class="icon"> <i class="fa fa-check"></i> </span> 
                    <span class="text">Chấp nhận</span> 
                    <span class="text-muted">20/07/2020 5:10:00</span>
                </div>
                <div class="step active"> 
                    <span class="icon"> <i class="fa fa-user"></i> </span> 
                    <span class="text"> Xuất đồ</span> 
                    <span class="text-muted">20/07/2020 6:00:00</span>
                </div>
                <div class="step"> 
                    <span class="icon"> <i class="fa fa-truck"></i> </span> 
                    <span class="text"> Trả đồ </span> 
                </div>
                <div class="step"> 
                    <span class="icon"> <i class="fa fa-box"></i> </span> 
                    <span class="text">Hoàn tất</span> 
                </div>
            </div> 
            <hr>
            <ul class="row">
                <li class="col-md-4">
                    <figure class="itemside mb-3">
                        <div class="aside"><img src="/img/sony-ax700.jpg" class="img-sm border"></div>
                        <figcaption class="info align-self-center">
                            <p class="title">Sony AX700 </p> <span class="text-muted">Số lượng: 2 </span>
                        </figcaption>
                    </figure>
                </li>
                <li class="col-md-4">
                    <figure class="itemside mb-3">
                        <div class="aside"><img src="/img/tripod.jpg" class="img-sm border"></div>
                        <figcaption class="info align-self-center">
                            <p class="title">Tripod</p> <span class="text-muted">Số lượng: 2</span>
                        </figcaption>
                    </figure>
                </li>
                <li class="col-md-4">
                    <figure class="itemside mb-3">
                        <div class="aside"><img src="/img/sony-pj440.png" class="img-sm border"></div>
                        <figcaption class="info align-self-center">
                            <p class="title">Sony PJ440</p> <span class="text-muted">Số lượng: 2</span>
                        </figcaption>
                    </figure>
                </li>
            </ul>
            <hr>
            <div class="row justify-content-center">
                <button class="btn btn-primary" data-abc="true"> Trả đồ</button>
            </div>
            
        </div>
    </article>
</div>
@endsection