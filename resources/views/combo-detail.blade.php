@extends('layouts.app')
<style>
input 
{
    width: 30px;
}
</style>
@section('content')
<div class="container">
    <div class="row py-3">
        <a href="{{ route('combo.index') }}" class="btn btn-secondary mr-auto">Back</a>
    </div>
    <div class="row">
        <div class="col-md-5">
            <img class="w-50" src="/img/sony-ax700.jpg" alt="sony-ax700">
            <img class="w-50" src="/img/tripod.jpg" alt="tripod">
        </div>
        <div class="col-md-7">
            <h2><b>Combo Sony AX700, Tripod</b></h2>
            <p><b>Chi tiết:</b> Sony AX700 + Tripod</p>
            <label>Số lượng mượn:</label>
            <input type="text" value="1">
            <button type="button" class="btn btn-danger">Thêm vào giỏ</button>
        </div>
    </div>
    <hr />
    <div class="row justify-content-center">
        <div class="row py-3">
            <div class="col-md-12 text-center">
                <h2>Danh sách thiết bị</h2>
            </div>
        </div>
        <div >
            <div class="row mx-2">
                <div class="card" style="width: 10rem;">
                    <img class="card-img-top" height=100 src="/img/sony-ax700.jpg" alt="sony-ax700">
                    <div class="card-body">
                        <h5 class="card-title">Sony AX700</h5>
                        <p class="card-text">
                            Số lượng: <input class="amount" type="text" name="" value="2" id="">
                        </p>
                        <a class="btn btn-danger btn-sm"><span class="fa fa-trash" /></a>
                    </div>
                </div>

                <div class="card" style="width: 10rem;">
                    <img class="card-img-top" height=100 src="/img/tripod.jpg" alt="sony-ax700">
                    <div class="card-body">
                        <h5 class="card-title">Tripod</h5>
                        <p class="card-text">
                            Số lượng: <input class="amount" type="text" name="" value="2" id="">
                        </p>
                        <a class="btn btn-danger btn-sm"><span class="fa fa-trash" /></a>
                    </div>
                </div>

                <div class="row justify-content-center pt-3">
                    <x-equipment-add />
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection