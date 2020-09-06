@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="row py-3">
            <div class="col-md-12 text-center">
                <h2>Danh sách nhà cung cấp</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            @if($suppliers->count() > 0)
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Mã</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Ghi chú</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suppliers as $supplier)
                    <tr>
                        <th class="align-middle" scope="row">{{ $supplier->id }}</th>
                        <td class="align-middle">{{ $supplier->name}}</td>
                        <td class="align-middle">{{ $supplier->address }}</td>
                        <td class="align-middle">{{ $supplier->phone_number }}</td>
                        <td class="align-middle">{{ $supplier->note }}</td>
                        <td class="align-middle">
                            <!-- Add equipment -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#{{'editSupplier'.$supplier->id}}">
                                <span class="fa fa-pencil"></span>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" 
                            onclick="event.preventDefault();
                            if(confirm('Bạn có chắc chắn muốn xóa?')){
                                document.getElementById('form-delete-{{$supplier->id}}')
                                .submit()
                            }">
                                <span class="fa fa-trash"></span>
                            </button>
                            <form style="display:none" id="{{'form-delete-'.$supplier->id}}" method="post" action="{{route('supplier.destroy',$supplier)}}">
                                @csrf
                                @method('delete')
                            </form>

                            <!-- Modal -->
                            <div class="modal fade" id="{{'editSupplier'.$supplier->id}}" tabindex="-1" role="dialog" aria-labelledby="editSupplierLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editSupplierLabel">Chỉnh sửa nhà cung cấp</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <div class="form-group">
                                                    <label><i class="fa fa-user"></i> Tên</label>
                                                    <input type="text" class="form-control" name="name" value="{{$supplier->name}}" placeholder="Tên nhà cung cấp">
                                                </div>
                                                <div class="form-group">
                                                    <label><i class="fa fa-address-card"></i> Địa chỉ</label>
                                                    <input type="text" class="form-control" name="address" value="{{$supplier->address}}" placeholder="Địa chỉ">
                                                </div>
                                                <div class="form-group">
                                                    <label for="price"><i class="fa fa-phone"></i> Số điện thoại</label>
                                                    <input type="text" class="form-control" name="phone_number" value="{{$supplier->phone_number}}" placeholder="Số điện thoại">
                                                </div>
                                                <div class="form-group">
                                                    <label><i class="fa fa-clipboard"></i> Ghi chú</label>
                                                    <textarea class="form-control" name="note" placeholder="Ghi chú" >{{$supplier->note}}</textarea>
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
            <h5>Chưa có nhà cung cấp nào.</h5>
            @endif
            <div class="row justify-content-center">
                <!-- Add supplier -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addSupplier">
                    <span class="fa fa-plus"></span>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="addSupplier" tabindex="-1" role="dialog" aria-labelledby="addSupplierLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addSupplierLabel">Thêm nhà cung cấp</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('supplier.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label><i class="fa fa-user"></i> Tên</label>
                                        <input required type="text" class="form-control" name="name" placeholder="Tên nhà cung cấp">
                                    </div>
                                    <div class="form-group">
                                        <label><i class="fa fa-address-card"></i> Địa chỉ</label>
                                        <input type="text" class="form-control" name="address"  placeholder="Địa chỉ">
                                    </div>
                                    <div class="form-group">
                                        <label for="price"><i class="fa fa-phone"></i> Số điện thoại</label>
                                        <input type="text" class="form-control" name="phone_number" placeholder="Số điện thoại">
                                    </div>
                                    <div class="form-group">
                                        <label><i class="fa fa-clipboard"></i> Ghi chú</label>
                                        <textarea class="form-control" name="note" placeholder="Ghi chú" ></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-2">Thêm nhà cung cấp</button>
                                </form>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection