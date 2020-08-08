@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center"><h1>Thêm combo mới</h1></div>
                <div class="card-body">
                    <form>
                        @csrf
                        <div class="form-group">
                            <label for="equipmentName">Tên thiết bị</label>
                            <input type="text" class="form-control" id="equipmentName" placeholder="Tên thiết bị">
                        </div>
                        <div class="form-group">
                            <label for="equipmentCategory">Loại thiết bị</label>
                            <div class="input-group">
                                <select class="form-control" id="equipmentCategory">
                                    <option>Máy quay</option>
                                    <option>Máy ảnh</option>
                                    <option>Chân máy</option>
                                    <option>Pin</option>
                                </select>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary"><span class="fa fa-plus"></span></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="equipmentImage">Hình ảnh thiết bị</label>
                            <input type="file" class="form-control-file" id="equipmentImage">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Tạo thiết bị</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection