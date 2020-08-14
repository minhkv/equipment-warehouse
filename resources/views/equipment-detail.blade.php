@extends('layouts.app')
<style>
input 
{
    width: 30px;
}
.checked {
  color: orange;
}
</style>
@section('content')
<div class="container">
    <div class="row py-3">
        <a href="{{ route('equipment-template.index') }}" class="btn btn-secondary mr-auto">Back</a>
    </div>
    <div class="row">
        <div class="col-md-4">
            <img class="w-100" src="{{ $equipmentTemplate->image }}" alt="sony-ax700">
        </div>
        <div class="col-md-8">
            <h2><b>Sony AX700</b></h2>
            <p><b>Số lượng trong kho:</b> {{ $equipmentTemplate->equipments->count() }}</p>
            <label>Số lượng mượn:</label>
            <input type="text" value="1">
            <a href="#" class="btn btn-warning"><span class="fa fa-plus"></span> Thêm vào giỏ</a>
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
                        <th scope="col">Ghi chú</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($equipmentTemplate->equipments as $equipment)
                    <tr>
                        <th class="align-middle" scope="row">{{ $equipment->id }}</th>
                        <td class="align-middle">{{ $equipment->size}}</td>
                        <td class="align-middle">{{ $equipment->price }}</td>
                        <td class="align-middle">{{ $equipment->supplier->name }}</td>
                        <td class="align-middle">{{ $equipment->location }}</td>
                        <td class="align-middle">
                            <div>
                                <span class="fa fa-star {{$equipment->condition >= 1 ? 'checked':''}}"></span>
                                <span class="fa fa-star {{$equipment->condition >= 2 ? 'checked':''}}"></span>
                                <span class="fa fa-star {{$equipment->condition >= 3 ? 'checked':''}}"></span>
                                <span class="fa fa-star {{$equipment->condition >= 4 ? 'checked':''}}"></span>
                                <span class="fa fa-star {{$equipment->condition >= 5 ? 'checked':''}}"></span>
                            </div>
                        </td>
                        <td>{{$equipment->note}}</td>
                        <td class="align-middle">
                            <x-edit-equipment-member e-id="{{ $equipment->id }}" />
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row justify-content-center">
                <x-add-equipment-member template-id="{{ $equipmentTemplate->id }}" />
            </div>
        </div>
    </div>
</div>
@endsection