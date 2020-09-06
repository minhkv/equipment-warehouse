@extends('layouts.app')
<style>
    input {
        width: 30px;
    }

    .checked {
        color: orange;
    }

    .overlay-button {
        position: absolute;
        top: 10px;
        left: 10px;
    }
</style>
<link rel="stylesheet" href="{{asset('css/star-input.css')}}">
@section('content')
<div class="container">
    <div class="row py-3">
        <a href="{{ route('equipment-template.index') }}" class="btn btn-secondary mr-auto">
            <i class="fa fa-chevron-left"></i> Quay lại
        </a>
    </div>
    <div class="row">
        <div class="col-md-4">
            <img class="w-100" src="{{ $equipmentTemplate->image }}" alt="{{ $equipmentTemplate->name }}">
            <div class="overlay-button">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#editImage">
                    <i class="fa fa-pencil"></i>
                </button>
                <div class="modal fade" id="editImage" tabindex="-1" role="dialog" aria-labelledby="editImageLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">&times;</button>
                            </div>
                            <div class="modal-body">       
                                <form id="updateImage" name="updateImage" action="{{ route('equipment-template.update', $equipmentTemplate) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input required type="file" name="imageFile" class="form-control-file" id="equipmentImage">
                                </form>                    
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button type="button" class="btn btn-primary" onclick="window.updateImage()">Lưu thay đổi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <h2><b>{{$equipmentTemplate->name}}</b>
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#editName">
                    <i class="fa fa-pencil"></i></button>
            </h2>
            <p><b>Số lượng thiết bị:</b> {{ $equipmentTemplate->equipments->count() }}</p>
            <label>Số lượng mượn:</label>
            <input type="text" value="1">
            <a href="#" class="btn btn-warning"><span class="fa fa-plus"></span> Thêm vào giỏ</a>

            <div class="modal fade" id="editName" tabindex="-1" role="dialog" aria-labelledby="editNameLabel"
                    aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">&times;</button>
                        </div>
                        <div class="modal-body">            
                            <form name="updateName" id="updateName" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="equipmentName">Nhập tên mới</label>
                                    <input type="text" class="form-control" id="equipmentName" name="name">
                                </div>
                            </form>            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-primary" onclick="window.updateName()">Lưu thay đổi</button>
                        </div>
                    </div>
                </div>
            </div>
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
                        <th class="text-center" scope="col" style="width: 5%">Mã</th>
                        <th class="text-center" scope="col" style="width: 10%;">Kích thước</th>
                        <th class="text-center" scope="col" style="width: 10%;">Giá nhập</th>
                        <th class="text-center" scope="col" style="width: 12%;">Nhà cung cấp</th>
                        <th class="text-center" scope="col" style="width: 8%;">Vị trí</th>
                        <th class="text-center" scope="col" style="width: 10%;">Tình trạng</th>
                        <th class="text-center" scope="col" style="width: 10%;">Trạng thái</th>
                        <th class="text-center" scope="col" style="width: 15%;">Ghi chú</th>
                        <th class="text-center" scope="col" style="width: 10%;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($equipmentTemplate->equipments as $equipment)
                    <tr>
                        <th class="align-middle text-center" scope="row">{{ $equipment->id }}</th>
                        <td class="align-middle text-center">{{ $equipment->size}}</td>
                        <td class="align-middle text-center">{{ $equipment->price }}</td>
                        <td class="align-middle text-center">{{ $equipment->supplier->name }}</td>
                        <td class="align-middle text-center">{{ $equipment->location }}</td>
                        <td class="align-middle text-center">
                            <div>
                                <span class="fa fa-star {{$equipment->condition >= 1 ? 'checked':''}}"></span>
                                <span class="fa fa-star {{$equipment->condition >= 2 ? 'checked':''}}"></span>
                                <span class="fa fa-star {{$equipment->condition >= 3 ? 'checked':''}}"></span>
                                <span class="fa fa-star {{$equipment->condition >= 4 ? 'checked':''}}"></span>
                                <span class="fa fa-star {{$equipment->condition >= 5 ? 'checked':''}}"></span>
                            </div>
                        </td>
                        <td class="align-middle text-center">{{$equipment->getStatusPretty()}}</td>
                        <td class="align-middle text-center">{{$equipment->note}}</td>
                        <td class="align-middle">
                            <x-edit-equipment-member e-id="{{ $equipment->id }}" />
                            <x-delete-button id="{{ $equipment->id }}" route-name="equipment.destroy" />
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
<script src="{{asset('js/star-input.js')}}"></script>
<script>
    function updateImage() {
        var imageFile = document.forms["updateImage"]["imageFile"].value;
        if(!imageFile) {
            alert("Bạn chưa chọn hình ảnh nào!");
            return;
        }
        document.getElementById('updateImage').submit();
    }
    function updateName() {
        var name = document.forms["updateName"]["name"].value;
        console.log(name);
        if(!name) {
            alert("Tên không được để trống!");
            return;
        }
        document.getElementById('updateName').submit();
    }
</script>