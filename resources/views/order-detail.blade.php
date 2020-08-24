@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/order-detail.css">
<style>
    .checked {
        color: orange;
    }
</style>
<div class="container">
    <article class="card">

        <div class="card-body">
            <!-- <div class="row"> -->
            <a href="{{ route('order.index') }}" class="btn btn-light mb-3" data-abc="true"> <i class="fa fa-chevron-left"></i> Quay lại</a>
            <!-- </div> -->
            <h3>Đơn mượn: {{$order->id}} {{$order->getStatus()}}</h3>
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
                    <span class="icon"> <i class="fa fa-book"></i> </span>
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
                    <span class="icon"> <i class="fa fa-thumbs-up"></i> </span>
                    <span class="text">Hoàn tất</span>
                    <span class="text-muted">{{$order->date_completed}}</span>
                </div>
            </div>
            <hr>
            <div class="row justify-content-center">
                <h3>
                    @switch($order->status)
                    @case(-1)
                    Từ chối
                    @break
                    @case(0)
                    Duyệt đơn
                    @break
                    @case(1)
                    Chọn đồ
                    @break
                    @case(2)
                    Kiểm đồ
                    @break
                    @case(4)
                    Hoàn tất
                    @break
                    @endswitch
                </h3>
            </div>
            <ul class="row justify-content-center">
                @foreach($order->orderRequestInfos as $info)
                @if(!($order->status >= 2 && $info->borrowed_amount == 0))
                <li class="col-md-4">
                    <figure class="itemside mb-3 border">
                        <div class="aside"><img src="{{$info->template->image}}" class="img-sm border"></div>
                        <figcaption class="info align-self-center">
                            <h5 class="title">{{$info->template->name}}</h5>
                            @if($order->status <= 1) 
                            <div class="form-group row">
                                <label for="borrowed-amount-{{$info->template->id}}" class="col-sm-6 col-form-label">Yêu cầu</label>
                                <div class="col-sm-4">
                                    <input class="form-control" style="width: 50px;" disabled type="number" value="{{ $info->amount }}">
                                </div>
                            </div>
                            @endif
                            @if($order->status >= 1)
                            <div class="form-group row">
                                <label for="borrowed-amount-{{$info->template->id}}" class="col-sm-6 col-form-label">Cho mượn</label>
                                <div class="col-sm-4">
                                    <input class="form-control" style="width: 50px;" disabled type="number" :value="getBorrowedAmount({{$info->template->id}})">
                                </div>
                                @if($order->status != 4)
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addEquipment-{{$info->template->id}}">
                                    <span class="fa fa-pencil"></span>
                                </button>
                                @endif
                            </div>


                            <!-- Modal -->
                            <div class="modal fade" id="addEquipment-{{$info->template->id}}" tabindex="-1" role="dialog" aria-labelledby="addEquipmentLabel-{{$info->template->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            @if($order->status <= 1) <h5 class="modal-title" id="addEquipmentLabel-{{$info->template->id}}">Thêm thiết bị {{$info->template->id}}</h5>
                                                @else
                                                <h5 class="modal-title" id="verifyEquipmentLabel-{{$info->template->id}}">Kiểm thiết bị {{$info->template->id}}</h5>
                                                @endif
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="py-2 my-lg-0 px-2">
                                                <div class="input-group">
                                                    <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm" aria-label="search" aria-describedby="basic-addon2">
                                                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><span class="fa fa-search"></span></button>
                                                </div>
                                            </form>
                                            @if($order->status <= 1) <table class="table">
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
                                                    @foreach($info->template->equipments as $equipment)
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
                                                        <td class="align-middle text-center">{{$equipment->getStatusPretty()}}</td>
                                                        <td>{{$equipment->note}}</td>
                                                        <td class="align-middle">
                                                            <button :disabled="disablePlusEquipmentButton({{$equipment->id}}, {{$equipment->status}})" @click="selectEquipment({{$equipment->id}}, {{$info->template->id}})" class="btn btn-success btn-sm"><span class="fa fa-plus"></span></button>
                                                            <button :disabled="disableMinusEquipmentButton({{$equipment->id}}, {{$equipment->status}})" @click="removeEquipment({{$equipment->id}}, {{$info->template->id}})" class="btn btn-danger btn-sm"><span class="fa fa-minus"></span></button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                </table>
                                                @else
                                                <table class="table">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th class="text-center" scope="col" style="width: 5%;">Mã</th>
                                                            <th class="text-center" scope="col" style="width: 20%;">Tình trạng trước khi mượn</th>
                                                            <th class="text-center" scope="col" style="width: 25%;">Tình trạng sau khi mượn</th>
                                                            <th class="text-center" scope="col" style="width: 25%;">Ghi chú</th>
                                                            <th class="text-center" scope="col">Đã nhận</th>
                                                            <th class="text-center" scope="col">Thất lạc</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($info->orderInfos as $orderInfo)
                                                        <tr>
                                                            <th class="text-center" class="align-middle" scope="row">{{ $orderInfo->equipment->id }}</th>
                                                            <td class="text-center" class="align-middle">
                                                                <div>
                                                                    <span class="fa fa-star {{$orderInfo->equipment->condition >= 1 ? 'checked':''}}"></span>
                                                                    <span class="fa fa-star {{$orderInfo->equipment->condition >= 2 ? 'checked':''}}"></span>
                                                                    <span class="fa fa-star {{$orderInfo->equipment->condition >= 3 ? 'checked':''}}"></span>
                                                                    <span class="fa fa-star {{$orderInfo->equipment->condition >= 4 ? 'checked':''}}"></span>
                                                                    <span class="fa fa-star {{$orderInfo->equipment->condition >= 5 ? 'checked':''}}"></span>
                                                                </div>
                                                            </td>
                                                            <td class="text-center" class="align-middle">
                                                                <x-star-input-condition id="condition-{{$orderInfo->equipment->id}}" name="condition-received-{{$orderInfo->equipment->id}}" value='{{ $orderInfo->equipment->condition }}' />
                                                            </td>
                                                            <td class="text-center">
                                                                <textarea class="form-control" name="note" cols="10"></textarea>
                                                            </td>
                                                            <td class="align-middle text-center pb-5">
                                                                <!-- Material checked -->
                                                                <div class="form-check">
                                                                    <input :disabled="equipmentLost[{{$orderInfo->equipment->id}}]" type="checkbox" class="form-check-input" v-model="equipmentReceived[{{$orderInfo->equipment->id}}]">
                                                                </div>
                                                            </td>
                                                            <td class="align-middle text-center pb-5">
                                                                <!-- Material checked -->
                                                                <div class="form-check">
                                                                    <input :disabled="equipmentReceived[{{$orderInfo->equipment->id}}]" type="checkbox" class="form-check-input" v-model="equipmentLost[{{$orderInfo->equipment->id}}]">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($order->status >= 2)
                            <div class="form-group row">
                                <label for="received-amount-{{$info->template->id}}" class="col-sm-6 col-form-label">Đã nhận</label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="received-amount-{{$info->template->id}}" style="width: 50px;" disabled type="number" :value="getReceivedAmount({{$info->template->id}})">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lost-amount-{{$info->template->id}}" class="col-sm-6 col-form-label">Thất lạc</label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="lost-amount-{{$info->template->id}}" style="width: 50px;" disabled type="number" :value="getLostAmount({{$info->template->id}})">
                                </div>
                            </div>
                            @endif
                        </figcaption>
                    </figure>
                </li>
                @endif
                @endforeach
            </ul>
            <hr>
            <div class="row justify-content-center">
                @switch($order->status)
                @case(0)
                <button :disabled="buttonDisabled" @click="acceptOrder" class="btn btn-primary mx-2" data-abc="true">Chấp nhận</button>
                <button :disabled="buttonDisabled" @click="rejectOrder" class="btn btn-danger" data-abc="true">Từ chối</button>
                @break
                @case(1)
                <button :disabled="buttonDisabled" @click="equipmentOutput" class="btn btn-primary" data-abc="true">Xuất đồ</button>
                @break
                @case(2)
                <button :disabled="buttonDisabled" @click="equipmentReturn" class="btn btn-primary" data-abc="true">Trả đồ</button>
                @break
                @case(3)
                <button :disabled="buttonDisabled" class="btn btn-primary" data-abc="true">Hoàn tất</button>
                @break

                @endswitch
            </div>
        </div>
    </article>
</div>
<script>
    var order = <?php echo $order; ?>;
    var acceptUrl = '<?php echo route('order-request.accept', $order); ?>';
    var rejectUrl = '<?php echo route('order-request.reject', $order); ?>';
    var equipmentOutputUrl = '<?php echo route('order-request.output', $order); ?>';
    var equipmentReturnUrl = '<?php echo route('order-request.return', $order); ?>';
    var orderIndexUrl = '<?php echo route('order.index'); ?>';
    var equipmentSelected = {};
    var equipmentReceived = {};
    var equipmentLost = {};
    var equipment_ids = [];
    var templateBorrowedAmount = {};
    var orderRequestInfos = {};
    order.order_request_infos.forEach(function(info) {
        info.order_infos.forEach(function(order_info) {
            order_info.condition_received = order_info.equipment.condition;
            equipmentSelected[order_info.equipment_id] = true;
            equipmentReceived[order_info.equipment_id] = (order_info.status == 1);
            equipmentLost[order_info.equipment_id] = (order_info.status == 0);
            equipment_ids.push(order_info.equipment_id);
        });
        orderRequestInfos[info.template.id] = info;
        orderRequestInfos[info.template.id]['order_infos'] = info.order_infos;
        templateBorrowedAmount[info.template.id] = info.order_infos.length;
        info.template.equipments.forEach(function(equipment) {
            equipmentSelected[equipment.id] = false;
        });

    });

    var app = new Vue({
        el: '.card',
        data: {
            order: order,
            equipment_ids: equipment_ids,
            buttonDisabled: false,
            templateBorrowedAmount: templateBorrowedAmount,
            equipmentSelected: equipmentSelected,
            equipmentReceived: equipmentReceived,
            equipmentLost: equipmentLost,
            orderRequestInfos: orderRequestInfos
        },
        methods: {
            disableButton: function() {
                this.buttonDisabled = true;
            },
            acceptOrder: function(button) {
                this.disableButton();
                axios.put(acceptUrl).then(res => {
                    console.log(res);
                    window.location.reload();
                }).catch(error => {
                    console.log("handlesubmit error: ", error);
                });
            },
            rejectOrder: function() {
                console.log(orderIndexUrl);
                this.disableButton();
                axios.put(rejectUrl)
                    .then(res => {
                        console.log(res);
                        window.location.assign(orderIndexUrl);
                    }).catch(error => {
                        console.log("handlesubmit error: ", error);
                    });
            },
            selectEquipment: function(equipment_id, template_id) {
                console.log('select');
                this.orderRequestInfos[template_id].order_infos.push({
                    'equipment_id': equipment_id
                });
                this.templateBorrowedAmount[template_id]++;
                this.equipment_ids.push(equipment_id);
                this.equipmentSelected[equipment_id] = true;
            },
            removeEquipment: function(equipment_id, template_id) {
                console.log('remove');
                this.templateBorrowedAmount[template_id]--;
                const index = this.equipment_ids.indexOf(equipment_id);
                if (index > -1) {
                    this.equipment_ids.splice(index, 1);
                }
                this.equipmentSelected[equipment_id] = false;
            },
            equipmentOutput: function() {
                this.disableButton();
                axios({
                        url: equipmentOutputUrl,
                        method: 'put',
                        data: {
                            equipments: this.equipment_ids,
                            templateBorrowedAmount: this.templateBorrowedAmount,
                            orderRequestInfos: this.orderRequestInfos
                        }
                    })
                    .then(function(response) {
                        console.log(response);
                        window.location.reload();
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            },
            updateOrderInfoStatus: function() {
                for (i in this.orderRequestInfos) {
                    for (j in this.orderRequestInfos[i].order_infos) {
                        var orderInfo = this.orderRequestInfos[i].order_infos[j];
                        orderInfo.status = this.getEquipmentStatus(orderInfo.equipment_id);
                    }
                }
            },
            equipmentCheck: function() {
                for (i in this.orderRequestInfos) {
                    for (j in this.orderRequestInfos[i].order_infos) {
                        var orderInfo = this.orderRequestInfos[i].order_infos[j];
                        if (!this.equipmentLost[orderInfo.equipment.id] && !this.equipmentReceived[orderInfo.equipment.id]) {
                            alert('Bạn chưa chọn trạng thái thiết bị ' + this.orderRequestInfos[i].template.name + ' có mã: ' + orderInfo.equipment.id);
                            return false;
                        }
                    }
                }
                return true;
            },
            equipmentReturn: function() {
                console.log('return');
                if (!this.equipmentCheck()) return;
                this.updateOrderInfoStatus();
                this.disableButton();

                axios({
                        url: equipmentReturnUrl,
                        method: 'put',
                        data: {
                            orderRequestInfos: this.orderRequestInfos
                        }
                    })
                    .then(function(response) {
                        console.log(response);
                        window.location.reload();
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            },
            getEquipmentStatus: function(equipmentId) {
                if (this.equipmentReceived[equipmentId])
                    return 1;
                if (this.equipmentLost[equipmentId])
                    return 0;
                return 2;
            },
            isEquipmentSelected: function(equipmentId) {
                return this.equipmentSelected[equipmentId];
            },
            disablePlusEquipmentButton: function(equipmentId, equipmentStatus) {
                return this.isEquipmentSelected(equipmentId) || equipmentStatus != 1;
            },
            disableMinusEquipmentButton: function(equipmentId, equipmentStatus) {
                return !this.isEquipmentSelected(equipmentId);
            },
            getBorrowedAmount: function(template_id) {
                return this.templateBorrowedAmount[template_id];
            },
            getReceivedAmount: function(template_id) {
                total = 0;
                for (i in this.orderRequestInfos[template_id].order_infos) {
                    var orderInfo = this.orderRequestInfos[template_id].order_infos[i];
                    if (this.equipmentReceived[orderInfo.equipment.id]) {
                        total += 1;
                    }
                }

                return total;
            },
            getLostAmount: function(template_id) {
                total = 0;
                for (i in this.orderRequestInfos[template_id].order_infos) {
                    var orderInfo = this.orderRequestInfos[template_id].order_infos[i];
                    if (this.equipmentLost[orderInfo.equipment.id]) {
                        total += 1;
                    }
                }

                return total;
            }
        }
    });

    function normalText(id, selected) {
        document.getElementById(id).innerHTML = "Đánh giá";
    }

    function changeText(id, text) {
        document.getElementById(id).innerHTML = text;
    }
</script>
@endsection