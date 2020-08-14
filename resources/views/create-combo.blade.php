@extends('layouts.app')
@section('content')
<style>
.amount{
    width: 50px
}
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center"><h1>Thêm combo mới</h1></div>
                <div class="card-body">
                    <form action="{{route('combo.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="equipmentName">Tên Combo</label>
                            <input type="text" class="form-control" id="equipmentName" name="name" placeholder="Tên combo">
                        </div>
                        
                        <div class="form-group">
                            <label>Danh sách thiết bị</label>
                            <div id="equipmentList" class="row mx-2 justify-content-center">
                                <input type="hidden" name="templates[]" :value="JSON.stringify(templates)">
                                <div class="col-md-4" v-for="(template, index) in templates">
                                    <div  class="card">
                                        <img class="card-img-top" :src="template.image" alt="sony-ax700">
                                        <div class="card-body">
                                            <h5 class="card-title">@{{ template.name }}</h5>
                                            <input type="hidden" name="template_id" :value="template.id">
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
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addEquipmentLabel">Thêm thiết bị</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- @{{equipments[0]->name}} -->
                                                    <form class="my-2 my-lg-0 px-2">
                                                        <div class="input-group">
                                                            <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm" aria-label="search" aria-describedby="basic-addon2">
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
                                                            @foreach($equipmentTemplates as $template)
                                                            <tr>
                                                                <th scope="row"><img src="{{$template->image}}" height=40 alt="{{$template->name}}"></th>
                                                                <td class="align-middle">{{ $template->name }}</td>
                                                                <td class="align-middle">{{ $template->equipments->count() }}</td>
                                                                <td class="align-middle">
                                                                    <!-- <input type="checkbox" id="{{'select-'.$template->id}}" name="select"> -->
                                                                    <button :disabled="buttonDisabled[{{$template->id}}]" v-on:click="addEquipment({{$template}});" type="button" class="btn btn-success" id="{{'select-template-'.$template->id}}">
                                                                        <span class="fa fa-plus"></span>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            @endforeach
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

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row justify-content-center pt-2">
                                <button type="submit" class="btn btn-success mb-2">Tạo combo</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var app = new Vue({
        el: '#equipmentList',
        data: {
            templates: [
            ],
            buttonDisabled: {}
        },
        methods:{
            addEquipment: function(template) {
                this.templates.push({
                    id: template.id,
                    name: template.name,
                    amount: '0',
                    maxAmount: template.equipments.length,
                    image: template.image
                });
                this.buttonDisabled[template.id] = true;
            },
            removeEquipmentCard: function(index) {
                templateId = this.templates[index].id;
                this.buttonDisabled[templateId] = false;
                this.templates.splice(index, 1);
            }
        }
    });
</script>
@endsection