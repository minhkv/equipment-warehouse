@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center"><h1>Thêm thiết bị mới</h1></div>
                <div class="card-body">
                    <form action="{{route('equipment-template.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="equipmentName">Tên thiết bị</label>
                            <input type="text" name="name" class="form-control" id="equipmentName" placeholder="Tên thiết bị">
                        </div>
                        <div class="form-group">
                            <label for="equipmentCategory">Loại thiết bị</label>
                            <div class="input-group">
                                <select name="category" class="form-control" id="equipmentCategory">
                                    @foreach($categories as $category)
                                    <option>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreateCategory">
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="equipmentImage">Hình ảnh thiết bị</label>
                            <input type="file" name="imageFile" class="form-control-file" id="equipmentImage">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Tạo thiết bị</button>
                    </form>

                    <div class="modal fade" id="modalCreateCategory" tabindex="-1" role="dialog" aria-labelledby="createCategoryLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createCategoryLabel">Thêm loại thiết bị</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('category.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="category">Loại sản phẩm</label>
                                            <input type="text" name="name" class="form-control" id="category" placeholder="Nhập loại sản phẩm">
                                        </div>
                                        <button type="submit" class="btn btn-success">Thêm</button>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection