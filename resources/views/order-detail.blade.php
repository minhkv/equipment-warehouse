@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/order-detail.css" >
<div class="container">
    <article class="card">
        
        <div class="card-body">
            <!-- <div class="row"> -->
                <a href="{{ route('order.index') }}" class="btn btn-light mb-3" data-abc="true"> <i class="fa fa-chevron-left"></i> Quay lại</a>
            <!-- </div> -->
            <h6>Đơn mượn: {{$order->id}} <span class="badge badge-primary">{{$order->status}}</span></h6>
            <article class="card">
                <div class="card-body row">
                    <div class="col"> <strong><i class="fa fa-user"></i> Người mượn:</strong> <br>{{$order->guest->name}} </div>
                    <div class="col"> <strong>Lý do:</strong> <br> {{$order->reason}} </div>
                    <div class="col"> <strong><i class="fa fa-calendar"></i> Thời hạn:</strong> <br> {{$order->due_date}} </div>
                    <div class="col"> <strong>Ghi chú:</strong> <br> {{$order->note}} </div>
                </div>
            </article>
            <div class="track">
                <div class="step {{$order->status >=0 ? 'active' : ''}}"> 
                    <span class="icon"> <i class="fa fa-file"></i> </span> 
                    <span class="text">Tạo đơn hàng</span> 
                    <span class="text-muted">{{$order->created_at}}</span> 
                </div>
                <div class="step {{$order->status >=1 ? 'active' : ''}}"> 
                    <span class="icon"> <i class="fa fa-check"></i> </span> 
                    <span class="text">Chấp nhận</span> 
                    <span class="text-muted">{{$order->date_approved}}</span>
                </div>
                <div class="step {{$order->status >=2 ? 'active' : ''}}"> 
                    <span class="icon"> <i class="fa fa-user"></i> </span> 
                    <span class="text"> Xuất đồ</span> 
                    <span class="text-muted">{{$order->date_output}}</span>
                </div>
                <div class="step {{$order->status >=3 ? 'active' : ''}}"> 
                    <span class="icon"> <i class="fa fa-truck"></i> </span> 
                    <span class="text"> Trả đồ </span> 
                    <span class="text-muted">{{$order->date_received}}</span>
                </div>
                <div class="step {{$order->status >=4 ? 'active' : ''}}"> 
                    <span class="icon"> <i class="fa fa-box"></i> </span> 
                    <span class="text">Hoàn tất</span> 
                    <span class="text-muted">{{$order->date_completed}}</span>
                </div>
            </div> 
            <hr>
            <div class="row justify-content-center">
                <h3>
                    @switch($order->status)
                        @case(0)
                            Duyệt đơn
                            @break
                        @case(1)
                            Chọn đồ
                            @break
                        @case(2)
                            Kiểm đồ
                            @break
                        @case(3)
                            Hoàn tất
                            @break
                    @endswitch
                </h3>
            </div>
            <ul class="row justify-content-center">
                @if($order->status == 0)
                    @foreach($order->orderRequestInfos as $info)
                    <li class="col-md-4">
                        <figure class="itemside mb-3">
                            <div class="aside"><img src="{{$info->template->image}}" class="img-sm border"></div>
                            <figcaption class="info align-self-center">
                                <p class="title">{{$info->template->name}}</p> <span class="text-muted">Số lượng: {{ $info->amount }} </span>
                            </figcaption>
                        </figure>
                    </li>
                    @endforeach
                @else
                    @foreach($order->orderInfos as $info)
                    <li class="col-md-4">
                        <figure class="itemside mb-3">
                            <div class="aside"><img src="{{$info->template->image}}" class="img-sm border"></div>
                            <figcaption class="info align-self-center">
                                <p class="title">{{$info->template->name}}</p> <span class="text-muted">Số lượng: {{ $info->amount }} </span>
                            </figcaption>
                        </figure>
                    </li>
                    @endforeach
                @endif
            </ul>
            <hr>
            <div class="row justify-content-center">
                @switch($order->status)
                    @case(0)
                        <button :disabled="buttonDisabled" @click="acceptOrder" class="btn btn-primary mx-2" data-abc="true">Chấp nhận</button>
                        <button :disabled="buttonDisabled" @click="rejectOrder" class="btn btn-danger" data-abc="true">Từ chối</button>
                        @break
                    @case(1)
                        <button :disabled="buttonDisabled" class="btn btn-primary" data-abc="true">Xuất đồ</button>
                        @break
                    @case(2)
                        <button :disabled="buttonDisabled" class="btn btn-primary" data-abc="true">Trả đồ</button>
                        @break
                    @case(3)
                        <button :disabled="buttonDisabled" class="btn btn-primary" data-abc="true">Hoàn tất</button>
                        @break
                    @case(4)
                        <button :disabled="buttonDisabled" class="btn btn-primary" data-abc="true">Quay lại</button>
                        @break
                @endswitch
            </div>
        </div>
    </article>
</div>
<script>
    var order = <?php echo $order; ?>;
    var updateUrl = '<?php echo route('order.update', $order);?>';
    var deleteUrl = '<?php echo route('order.destroy', $order);?>';
    var orderIndexUrl = '<?php echo route('order.index');?>';
    var app = new Vue({
        el: '.card',
        data: {
            order: order,
            buttonDisabled: false,
        },
        methods:{
            acceptOrder: function(button) {
                this.buttonDisabled = true;
                axios.put(updateUrl, {
                    status: '0'
                }).then(res => {
                    console.log(res);
                    window.location.reload();
                }).catch(error => {
                    console.log("handlesubmit error: ", error);
                });
            },
            rejectOrder: function() {
                console.log(orderIndexUrl);
                this.buttonDisabled = true;
                axios.delete(deleteUrl)
                .then(res => {
                    console.log(res);
                    window.location.assign(orderIndexUrl);
                }).catch(error => {
                    console.log("handlesubmit error: ", error)
                });
            },
            equipmentOutput: function() {

            },
            equipmentReturn: function() {

            }
        }
    });
</script>
@endsection