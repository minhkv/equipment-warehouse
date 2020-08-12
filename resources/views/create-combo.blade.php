@extends('layouts.app')
@section('content')
<style>
.amount{
    width: 30px
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center"><h1>Thêm combo mới</h1></div>
                <div class="card-body">
                    <form>
                        @csrf
                        <div class="form-group">
                            <label for="equipmentName">Tên Combo</label>
                            <input type="text" class="form-control" id="equipmentName" placeholder="Tên combo">
                        </div>
                        
                        <div class="form-group">
                            <label>Danh sách thiết bị</label>
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
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-success mb-2">Tạo combo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection