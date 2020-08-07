@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center"><h2>Thiết bị</h2></div>
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="/img/equipment.jpg" class="card-img" alt="Equipment">
                    </div>
                    <div class="card-body">
                        <div class="col-md-8">
                            <p class="card-text">Tổng</p>
                            <p class="card-text">Cho mượn</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center"><h2>Đơn hàng</h2></div>
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="/img/report.jpg" class="card-img" alt="Equipment">
                    </div>
                    <div class="card-body">
                        <div class="col-md-8">
                            <p class="card-text">Tổng</p>
                            <p class="card-text">Đang tiến hành</p>
                            <p class="card-text">Hết hạn</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
