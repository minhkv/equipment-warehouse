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
                        <div>
                            <div class="form-group row">
                                <label for="totalEquipmentAmount" class="col-sm-5 col-form-label">Tổng</label>
                                <div class="col-sm-4 input-group">
                                    <input id="totalEquipmentAmount" class="form-control" style="width: 80px;" disabled type="number" value="{{$totalEquipmentAmount}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="borrowedAmount" class="col-sm-5 col-form-label">Sẵn sàng</label>
                                <div class="col-sm-4 input-group">
                                    <input id="borrowedAmount" class="form-control" style="width: 80px;" disabled type="number" value="{{$equipmentAvailableAmount}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="borrowedAmount" class="col-sm-5 col-form-label">Cho mượn</label>
                                <div class="col-sm-4 input-group">
                                    <input id="borrowedAmount" class="form-control" style="width: 80px;" disabled type="number" value="{{$equipmentWorkingAmount}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="borrowedAmount" class="col-sm-5 col-form-label">Thất lạc</label>
                                <div class="col-sm-5 input-group">
                                    <input id="borrowedAmount" class="form-control" style="width: 80px;" disabled type="number" value="{{$equipmentLostAmount}}">
                                    <a href="{{route('equipment-template.lost')}}" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span></a>
                                </div>
                            </div>
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
                        <div>
                            <div class="form-group row">
                                <label for="totalOrderAmount" class="col-sm-5 col-form-label">Tổng</label>
                                <div class="col-sm-4 input-group">
                                    <input id="totalOrderAmount" class="form-control" style="width: 80px;" disabled type="number" value="{{$totalOrderAmount}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="orderProcessingAmount" class="col-sm-5 col-form-label">Đang chờ</label>
                                <div class="col-sm-4 input-group">
                                    <input id="orderProcessingAmount" class="form-control" style="width: 80px;" disabled type="number" value="{{$orderPendingAmount}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="orderProcessingAmount" class="col-sm-5 col-form-label">Đang tiến hành</label>
                                <div class="col-sm-4 input-group">
                                    <input id="orderProcessingAmount" class="form-control" style="width: 80px;" disabled type="number" value="{{$orderProcessingAmount}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="orderProcessingAmount" class="col-sm-5 col-form-label">Hoàn tất</label>
                                <div class="col-sm-4 input-group">
                                    <input id="orderProcessingAmount" class="form-control" style="width: 80px;" disabled type="number" value="{{$orderCompletedAmount}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
