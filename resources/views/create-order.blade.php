@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/create-order.css" >
<link rel="stylesheet" href="/css/order-detail.css" >
<div class="container">
    <div class="row justify-content-center">
        <div class="main-card mb-3 card col-md-6">
            <div class="card-header">
                <div class="btn-actions-pane-right">
                    <div class="nav">
                        <a data-toggle="tab" href="#tab-eg2-0" class="btn-pill btn-wide active btn btn-outline-alternate btn-sm">Đơn mượn</a>
                        <a data-toggle="tab" href="#tab-eg2-1" class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-alternate btn-sm">Đơn nhập</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-eg2-0" role="tabpanel">
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="equipmentName">Người mượn</label>
                                <input type="text" class="form-control" id="equipmentName" placeholder="Người mượn">
                            </div>
                            
                            <div class="form-group">
                                <label for="reason">Lý do mượn</label>
                                <textarea class="form-control" id="reason" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Danh sách thiết bị</label>
                                <div class="row mx-2">
                                    <div class="card" style="width: 10rem;">
                                        <img class="card-img-top" src="/img/sony-ax700.jpg" alt="sony-ax700">
                                        <div class="card-body">
                                            <h5 class="card-title">Sony AX700</h5>
                                            <p class="card-text">Số lượng: 2</p>
                                            <a class="btn btn-primary btn-sm"><span class="fa fa-pencil" /></a>
                                            <a class="btn btn-danger btn-sm"><span class="fa fa-trash" /></a>
                                        </div>
                                    </div>
                                    <div class="card" style="width: 10rem;">
                                        <img class="card-img-top" src="/img/sony-ax700.jpg" alt="sony-ax700">
                                        <div class="card-body">
                                            <h5 class="card-title">Sony AX700</h5>
                                            <p class="card-text">Số lượng: 2</p>
                                            <a class="btn btn-primary btn-sm"><span class="fa fa-pencil" /></a>
                                            <a class="btn btn-danger btn-sm"><span class="fa fa-trash" /></a>
                                        </div>
                                    </div>
                                    <div class="card" style="width: 10rem;">
                                        <img class="card-img-top" src="/img/sony-ax700.jpg" alt="sony-ax700">
                                        <div class="card-body">
                                            <h5 class="card-title">Sony AX700</h5>
                                            <p class="card-text">Số lượng: 2</p>
                                            <a class="btn btn-primary btn-sm"><span class="fa fa-pencil" /></a>
                                            <a class="btn btn-danger btn-sm"><span class="fa fa-trash" /></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success mb-2">Tạo đơn mượn</button>
                        </form>
                    </div>
                    <div class="tab-pane" id="tab-eg2-1" role="tabpanel">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection