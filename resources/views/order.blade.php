@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Đơn mượn thiết bị</h2>
        </div>
    </div>
    <div class="row py-4">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Loại đơn
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Đơn nhập</a>
                <a class="dropdown-item" href="#">Đơn mượn</a>
            </div>
        </div>
        <div class="dropdown ml-4">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Lọc theo
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </div>
        <div class="dropdown ml-4">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Sắp xếp theo
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </div>
        <button type="button" class="btn btn-danger ml-auto">Tạo đơn hàng</button>
    </div>
    <div class="row">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Mã đơn</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>20/07/2020</td>
                    <td>20</td>
                    <td><p class="btn btn-primary">Đang tiến hành</p></td>
                    <td>
                        <button class="btn btn-primary"><span class="fa fa-pencil" /></button>
                        <button class="btn btn-danger"><span class="fa fa-trash" /></button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>21/07/2020</td>
                    <td>25</td>
                    <td><p class="btn btn-primary">Đang tiến hành</p></td>
                    <td>
                        <button class="btn btn-primary"><span class="fa fa-pencil" /></button>
                        <button class="btn btn-danger"><span class="fa fa-trash" /></button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>22/07/2020</td>
                    <td>30</td>
                    <td><p class="btn btn-warning">Chờ xử lý</p></td>
                    <td>
                        <button class="btn btn-primary"><span class="fa fa-pencil" /></button>
                        <button class="btn btn-danger"><span class="fa fa-trash" /></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection