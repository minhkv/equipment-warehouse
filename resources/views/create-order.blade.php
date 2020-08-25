@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/create-order.css" >
<link rel="stylesheet" href="/css/order-detail.css" >
<!-- <link rel="stylesheet" href="/css/card.css" > -->
<style>
.amount
{
    width: 50px
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="main-card mb-3 card col-md-8">
            <div class="card-header">
                <div class="row py-3">
                    <a href="{{ route('order.index') }}" class="btn btn-secondary mr-auto">Back</a>
                </div>
                <div class="btn-actions-pane-right">
                    <div class="nav">
                        <a data-toggle="tab" href="#tab-eg2-0" class="btn-pill btn-wide active btn btn-outline-alternate btn-sm">Đơn mượn</a>
                        <a data-toggle="tab" href="#tab-eg2-1" class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-alternate btn-sm">Đơn nhập</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-eg2-0" role="tabpanel">
                        <form id="formCreateOrder" action="{{route('order-request.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="type" value="1">
                                <input type="hidden" name="stocker_id" value="{{$stocker_id}}">
                            </div>
                            <div class="form-group">
                                <label for="equipmentName">Người mượn</label>
                                <select name="guest_id" class="form-control" id="equipmentCategory">
                                    @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                                
                                <!-- <input type="text" class="form-control" id="equipmentName" placeholder="Người mượn"> -->
                            </div>
                            <div class="form-group">
                                <label for="reason">Lý do mượn</label>
                                <textarea class="form-control" id="reason" name="reason" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Danh sách thiết bị</label>
                                <div id="equipmentList" class="row mx-2 justify-content-center">
                                    <input type="hidden" name="templates[]" :value="JSON.stringify(selectedTemplates)">
                                    <div class="col-md-4 my-1" v-for="(template, index) in selectedTemplates">
                                        <div class="card shadow">
                                            <img class="card-img-top" :src="template.image" alt="sony-ax700">
                                            <div class="card-body d-flex flex-column">
                                                <div class="mt-auto">

                                                    <h5 class="card-title">@{{ template.name }}</h5>
                                                    <input type="hidden" name="template_id" :value="template.id">
                                                </div>
                                                    <p class="card-text">
                                                        Số lượng: <input class="amount" type="number" name="amount" min='0' :max='template.maxAmount' value="1" v-model="template.amount">
                                                    </p>
                                                <button type="button" v-on:click="removeEquipmentCard(index)" class="btn btn-danger btn-sm"><span class="fa fa-trash" /></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row justify-content-center pt-3">
                                        <!-- Add equipment -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEquipment">
                                            <span class="fa fa-plus"></span>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="addEquipment" tabindex="-1" role="dialog" aria-labelledby="addEquipmentLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addEquipmentLabel">Thêm thiết bị</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="my-2 my-lg-0 px-2">
                                                            <div class="input-group">
                                                                <input v-model="search" class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm" aria-label="search" aria-describedby="basic-addon2">
                                                                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><span class="fa fa-search"></span></button>
                                                            </div>
                                                        </form>
                                                        <table class="table mt-2">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th scope="col"></th>
                                                                    <th scope="col">Tên thiết bị</th>
                                                                    <th scope="col">Số lượng</th>
                                                                    <th scope="col">Chọn</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="(template, index) in searchTemplates()">
                                                                    <th scope="row"><img :src="template.image" height=40 :alt="template.name"></th>
                                                                    <td class="align-middle">@{{ template.name }}</td>
                                                                    <td class="align-middle">@{{ template.equipments.length }}</td>
                                                                    <td class="align-middle">
                                                                        <button :disabled="buttonDisabled[template.id]" v-on:click="addEquipment(template);" type="button" class="btn btn-success" :id="'select-template-' + template.id">
                                                                            <span class="fa fa-plus"></span>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="row justify-content-center">
                                                            <nav aria-label="Page navigation example">
                                                                <ul class="pagination">
                                                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                                                    <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                                                </ul>
                                                            </nav>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Xong</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="row justify-content-center pt-3">
                                    <button @click="submitBorrowedOrder" type="button" class="btn btn-success mb-2">Tạo đơn mượn</button>
                                </div>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                    <div class="tab-pane" id="tab-eg2-1" role="tabpanel">
                        
                    </div>
                </div>
            </div>
            <div class="card-header">
            </div>
            
        </div>
    </div>
</div>
<script>
    var templates = <?php echo $equipmentTemplates; ?>;
    var app = new Vue({
        el: '#equipmentList',
        data: {
            selectedTemplates: [
            ],
            templates: templates,
            buttonDisabled: {},
            search: ''
        },
        methods:{
            addEquipment: function(template) {
                this.selectedTemplates.push({
                    id: template.id,
                    name: template.name,
                    amount: '0',
                    maxAmount: template.equipments.length,
                    image: template.image
                });
                this.buttonDisabled[template.id] = true;
            },
            removeEquipmentCard: function(index) {
                templateId = this.selectedTemplates[index].id;
                this.buttonDisabled[templateId] = false;
                this.selectedTemplates.splice(index, 1);
            },
            checkZeroAmount: function(template) {
                if(template.amount == 0) {
                    return true;
                }
                return false;
            },
            searchTemplates: function() {
                var search = this.search.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
                return this.templates.filter(function(template) {
                    var name = template.name.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
                    return (name.includes(search));
                });
            },
            submitBorrowedOrder: function() {
                console.log('submit');
                if(this.selectedTemplates.length == 0) {
                    alert('Bạn chưa chọn thiết bị nào!');
                    return;
                }
                for(i in this.selectedTemplates) {
                    if(this.selectedTemplates[i].amount == 0) {
                        alert('Số lượng mượn của thiết bị ' + this.selectedTemplates[i].name + ' phải lớn hơn 0!');
                        return;
                    }
                }
                document.getElementById('formCreateOrder').submit();
            }
        }
    });
</script>
@endsection