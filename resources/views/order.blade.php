@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="main-card mb-3 card col-md-12">
            <!-- <div class="card-header">
                <div class="btn-actions-pane-right">
                    <div class="nav">
                        <a data-toggle="tab" href="#tab-eg2-0" class="btn-pill btn-wide active btn btn-outline-alternate btn-sm">Đơn mượn</a>
                        <a data-toggle="tab" href="#tab-eg2-1" class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-alternate btn-sm">Đơn nhập</a>
                    </div>
                </div>
            </div> -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-eg2-0" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h2>Đơn mượn thiết bị</h2>
                            </div>
                        </div>
                        <div class="row py-4">
                            <a href="{{ route('order.create') }}" type="button" class="btn btn-success ml-auto">Tạo đơn</a>
                        </div>
                        <div class="row">
                            @if($orders->count() > 0)
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Mã đơn</th>
                                        <th scope="col">Người mượn</th>
                                        <th scope="col">Lý do mượn</th>
                                        <th scope="col">Ngày tạo</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <th scope="row" class="align-middle">{{$order->id}}</th>
                                        <td class="align-middle">{{$order->guest->name}}</td>
                                        <td class="align-middle">{{$order->reason}}</td>
                                        <td class="align-middle">{{$order->created_at}}</td>
                                        <td class="align-middle">
                                        @if($order->status <= 1)
                                            {{$order->getTotalRequestAmount()}}
                                        @else
                                            {{$order->getTotalBorrowedAmount()}}
                                        @endif
                                            
                                        </td>
                                        <td class="align-middle"><h5>{{$order->getStatus()}}</h5></td>
                                        <td class="align-middle">
                                            <a href="{{ route('order.show', $order) }}" class="btn btn-primary"><span class="fa fa-pencil" /></a>
                                            @if($order->status == -1 || $order->status == 4)
                                            <button type="button" class="btn btn-danger" 
                                            onclick="event.preventDefault();
                                            if(confirm('Bạn có chắc chắn muốn xóa?')){
                                                document.getElementById('form-delete-{{$order->id}}')
                                                .submit()
                                            }">
                                                <span class="fa fa-trash"></span>
                                            </button>
                                            <form style="display:none" id="{{'form-delete-'.$order->id}}" method="post" action="{{route('order.destroy',$order)}}">
                                                @csrf
                                                @method('delete')
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="row justify-content-center">
                                <h5>Chưa có đơn mượn nào.</h5>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-eg2-1" role="tabpanel">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection