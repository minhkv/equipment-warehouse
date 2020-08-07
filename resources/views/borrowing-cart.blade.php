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
                            <button class="btn btn-primary"><span class="fa fa-pencil" /></button>
                            <button class="btn btn-danger"><span class="fa fa-trash" /></button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><img src="/img/sony-pj440.png" height=100 alt="sony-pj440"></th>
                        <td class="align-middle">Sony PJ440</td>
                        <td class="align-middle">2</td>
                        <td class="align-middle">
                            <button class="btn btn-primary"><span class="fa fa-pencil" /></button>
                            <button class="btn btn-danger"><span class="fa fa-trash" /></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="row justify-content-center">
            <p><b>Tổng cộng: 4</b></p>
        </div>
        <div class="row col-md-6">
            <label for="reason">Lý do mượn:</label>
            <textarea class="form-control" rows="5" cols="20" id="reason"></textarea>
        </div>
        <div class="row py-4 justify-content-center">
            <button class="btn btn-warning">Tạo yêu cầu</button>
        </div>
    </div>
    
</div>
@endsection