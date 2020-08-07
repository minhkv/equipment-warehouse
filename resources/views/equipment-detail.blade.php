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
        <a href="{{ route('equipment') }}" class="btn btn-secondary mr-auto">Back</a>
    </div>
    <div class="row">
        <div class="col-md-5">
            <img class="w-100" src="/img/sony-ax700.jpg" alt="sony-ax700">
        </div>
        <div class="col-md-7">
            <h2><b>Sony AX700</b></h2>
            <p><b>Số lượng trong kho:</b> 6</p>
            <label>Số lượng mượn:</label>
            <input type="text" value="1">
            <button type="button" class="btn btn-danger">Thêm vào giỏ</button>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="row py-3">
            <div class="col-md-12 text-center">
                <h2>Danh sách thiết bị</h2>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Mã</th>
                        <th scope="col">Kích thước</th>
                        <th scope="col">Giá nhập</th>
                        <th scope="col">Nhà cung cấp</th>
                        <th scope="col">Vị trí</th>
                        <th scope="col">Tình trạng</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="align-middle" scope="row">1</th>
                        <td class="align-middle">196.5mm x 89.5mm</td>
                        <td class="align-middle">49,900,000vnd</td>
                        <td class="align-middle">Sony</td>
                        <td class="align-middle">Giá 3</td>
                        <td class="align-middle"><button class="btn btn-success">Tốt</button></td>
                        <td class="align-middle">
                            <button class="btn btn-danger">Thêm vào giỏ</button>
                        </td>
                    </tr>
                    <tr>
                        <th class="align-middle" scope="row">2</th>
                        <td class="align-middle">196.5mm x 89.5mm</td>
                        <td class="align-middle">49,900,000vnd</td>
                        <td class="align-middle">Sony</td>
                        <td class="align-middle">Giá 3</td>
                        <td class="align-middle"><button class="btn btn-warning">Hỏng nhẹ</button></td>
                        <td class="align-middle">
                            <button class="btn btn-danger">Thêm vào giỏ</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection