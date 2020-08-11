@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Giỏ đồ</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Tên thiết bị</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row"><img src="/img/sony-ax700.webp" height=100 alt="sony-ax700"></th>
                        <td class="align-middle">Sony AX700</td>
                        <td class="align-middle">2</td>
                        <td class="align-middle">
                            <button class="btn btn-danger btn-sm"><span class="fa fa-trash" /></button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><img src="/img/sony-pj440.png" height=100 alt="sony-pj440"></th>
                        <td class="align-middle">Sony PJ440</td>
                        <td class="align-middle">2</td>
                        <td class="align-middle">
                            <button class="btn btn-danger btn-sm"><span class="fa fa-trash" /></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row justify-content-center py-3">
                <x-equipment-add />
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="row justify-content-center">
            <p><b>Tổng cộng: 4</b></p>
        </div>
        
        <div class="row py-4 justify-content-center">
            <a href="{{ route('create-order') }}" class="btn btn-success">Tạo yêu cầu</a>
        </div>
    </div>
    
</div>
@endsection