@extends('layouts.app')
@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Combo thiết bị</h2>
        </div>
    </div>

    <div class="row">
        <a href="{{ route('create-combo') }}" class="btn btn-success ml-auto">Tạo combo</a>
    </div>
    
    <div class="row justify-content-center py-4">
        <div class="col-md-4">
            <div class="card">
                <img src="/img/sony-ax700.webp" class="card-img-top" alt="sony ax700">
                <div class="card-body">
                    <h2 class="card-title">Combo Sony AX700, Tripod</h2>
                    <p class="card-text">Số lượng: 6</p>
                    <a href="#" class="btn btn-success"><span class="fa fa-plus"></span></a>
                    <a href="{{ route('combo-detail', '1') }}" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
                    <a href="#" class="btn btn-danger"><span class="fa fa-trash"></span></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="/img/sony-pj440.png" class="card-img-top" alt="sony pj440">
                <div class="card-body">
                    <h2 class="card-title">Combo Sony PJ440, Tripod</h2>
                    <p class="card-text">Số lượng: 3</p>
                    <a href="#" class="btn btn-success"><span class="fa fa-plus"></span></a>
                    <a href="#" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
                    <a href="#" class="btn btn-danger"><span class="fa fa-trash"></span></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="/img/sony-ax700.webp" class="card-img-top" alt="sony ax700">
                <div class="card-body">
                    <h2 class="card-title">Combo Sony AX700, Tripod</h2>
                    <p class="card-text">Số lượng: 6</p>
                    <a href="#" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
                    <a href="#" class="btn btn-danger"><span class="fa fa-trash"></span></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection