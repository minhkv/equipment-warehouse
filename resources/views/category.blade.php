@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="row py-3">
            <div class="col-md-12 text-center">
                <h2>Danh sách loại thiết bị</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if($categories->count() > 0)
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Mã</th>
                            <th scope="col">Tên</th>
                            <th scope="col" style="width:  18.33%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <th class="align-middle" scope="row">{{ $category->id }}</th>
                            <td class="align-middle">{{ $category->name}}</td>
                            <td class="align-middle">
                                <!-- Add equipment -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#{{'editcategory'.$category->id}}">
                                    <span class="fa fa-edit"></span>
                                </button>
                                <button href="{{route('category.destroy', $category)}}" type="button" class="btn btn-danger" 
                                onclick="event.preventDefault();
                                if(confirm('Bạn có chắc chắn muốn xóa?')){
                                    document.getElementById('form-delete-{{$category->id}}')
                                    .submit()
                                }">
                                    <span class="fa fa-trash"></span>
                                </button>
                                <form style="display:none" id="{{'form-delete-'.$category->id}}" method="post" action="{{route('category.destroy',$category)}}">
                                    @csrf
                                    @method('delete')
                                </form>

                                <!-- Modal -->
                                <div class="modal fade" id="{{'editcategory'.$category->id}}" tabindex="-1" role="dialog" aria-labelledby="editCategoryLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editCategoryLabel">Chỉnh sửa loại thiết bị</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('category.update', $category->id) }}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="form-group">
                                                        <label><i class="fa fa-user"></i> Tên</label>
                                                        <input type="text" class="form-control" name="name" value="{{$category->name}}" placeholder="Tên loại thiết bị">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary mb-2">Lưu thay đổi</button>
                                                </form>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <h5>Chưa có thể loại nào.</h5>
                @endif
                <div class="row justify-content-center">
                    <!-- Add category -->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addCategory">
                        <span class="fa fa-plus"></span>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="addCategoryLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addcategoryLabel">Thêm loại thiết bị</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('category.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label><i class="fa fa-user"></i> Tên</label>
                                            <input type="text" class="form-control" name="name" placeholder="Tên loại thiết bị">
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-2">Thêm loại thiết bị</button>
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