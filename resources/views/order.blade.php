@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Đơn mượn thiết bị</h2>
        </div>
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