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
    <div class="row">
        <div class="row py-3">
            <div class="col-md-12 text-center">
                <h2>Danh sách thiết bị</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Sony AX700</th>
                            <th scope="col">Tripod</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="align-middle" scope="row">1</th>
                            <td class="align-middle">SN001</td>
                            <td class="align-middle">TR001</td>
                            <td class="align-middle">
                                <button class="btn btn-primary"><span class="fa fa-pencil" /></button>
                            </td>
                        </tr>
                        <tr>
                            <th class="align-middle" scope="row">2</th>
                            <td class="align-middle">SN002</td>
                            <td class="align-middle">TR002</td>
                            <td class="align-middle">
                                <button class="btn btn-primary"><span class="fa fa-pencil" /></button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-center">
                                <button class="btn btn-primary">
                                    <span class="fa fa-plus"></span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="row justify-content-center py-4">
                    <button class="btn btn-danger">Thêm vào giỏ</button>
                </div>
            </div>
            
        </div>
    </div>
    
</div>
@endsection