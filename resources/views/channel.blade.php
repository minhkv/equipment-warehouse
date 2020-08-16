@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="row py-3">
            <div class="col-md-12 text-center">
                <h2>Danh sách kênh</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if($channels->count() > 0)
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Mã</th>
                            <th scope="col">Tên</th>
                            <th scope="col" style="width:  18.33%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($channels as $channel)
                        <tr>
                            <th class="align-middle" scope="row">{{ $channel->id }}</th>
                            <td class="align-middle">{{ $channel->name}}</td>
                            <td class="align-middle">
                                <!-- Add equipment -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#{{'editchannel'.$channel->id}}">
                                    <span class="fa fa-pencil"></span>
                                </button>
                                <button href="{{route('channel.destroy', $channel)}}" type="button" class="btn btn-danger" 
                                onclick="event.preventDefault();
                                if(confirm('Bạn có chắc chắn muốn xóa?')){
                                    document.getElementById('form-delete-{{$channel->id}}')
                                    .submit()
                                }">
                                    <span class="fa fa-trash"></span>
                                </button>
                                <form style="display:none" id="{{'form-delete-'.$channel->id}}" method="post" action="{{route('channel.destroy',$channel)}}">
                                    @csrf
                                    @method('delete')
                                </form>

                                <!-- Modal -->
                                <div class="modal fade" id="{{'editchannel'.$channel->id}}" tabindex="-1" role="dialog" aria-labelledby="editCategoryLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editCategoryLabel">Chỉnh sửa kênh</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('channel.update', $channel->id) }}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="form-group">
                                                        <label><i class="fa fa-user"></i> Tên</label>
                                                        <input type="text" class="form-control" name="name" value="{{$channel->name}}" placeholder="Tên kênh">
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
                <h5>Chưa có kênh nào.</h5>
                @endif
                <div class="row justify-content-center">
                    <!-- Add channel -->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addCategory">
                        <span class="fa fa-plus"></span>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="addCategoryLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addchannelLabel">Thêm kênh</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('channel.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label><i class="fa fa-user"></i> Tên</label>
                                            <input type="text" class="form-control" name="name" placeholder="Tên kênh">
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-2">Thêm kênh</button>
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