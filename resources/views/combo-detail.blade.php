@extends('layouts.app')
<style>
input 
{
    width: 50px;
}
</style>
@section('content')
<div class="container">
    <div class="row py-3">
        <a href="{{ route('combo.index') }}" class="btn btn-secondary mr-auto">Back</a>
    </div>
    <div class="row">
        <div class="col-md-4">
            @if($combo->comboInfos->count() > 0)
            <img src="{{ $combo->comboInfos[0]->template->image }}" class="card-img-top" alt="{{$combo->name}}">
            @else
            <img src="/storage/img/empty.jpg" class="card-img-top" alt="{{$combo->name}}">
            @endif
        </div>
        <div class="col-md-8">
            <h2><b>{{$combo->name}}</b></h2>
            <!-- <p><b>Chi tiết:</b> Sony AX700 + Tripod</p> -->
            <label>Số lượng mượn:</label>
            <input type="number" min="0" value="1">
            <button type="button" class="btn btn-danger">Thêm vào giỏ</button>
        </div>
    </div>
    <hr />
    <div id="equipmentList" class="row justify-content-center">
        <div class="row py-3">
            <div class="col-md-12 text-center">
                <h2>Danh sách thiết bị</h2>
            </div>
        </div>
        <div>
            <div class="row mx-2 justify-content-center">
                <div v-for="(info, index) in selectedTemplates" class="col-md-2" >
                    <div  class="card">
                        <img class="card-img-top" :src="info.template.image" :alt="info.template.name">
                        <div class="card-body">
                            <h5 class="card-title">@{{info.template.name}}</h5>
                            <p class="card-text">
                                Số lượng: <input class="amount" type="number" name="" min="0" :value="info.amount">
                            </p>
                            <a class="btn btn-danger btn-sm"><span class="fa fa-trash" /></a>
                        </div>
                    </div>
                </div>
                
                <div class="row justify-content-center pt-3">
                    <!-- Add equipment -->
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
                                                        <button :disabled="buttonDisabled[{{$template->id}}]" v-on:click="addEquipment({{$template}});" type="button" class="btn btn-success">
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
                    <!-- End Add Equipment -->
                    <div class="row justify-content-center pt-3">
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
</div>

<script>
    var equipmentTemplates = <?php echo $equipmentTemplates; ?>;
    var combo = <?php echo $combo; ?>;
    var buttonDisabled = {};
    var combo_infos = combo.combo_infos;
    combo_infos.forEach(function(info){
        buttonDisabled[info["template_id"]] = true;
    });

    var app = new Vue({
        el: '#equipmentList',
        data: {
            combo: combo,
            templates: equipmentTemplates,
            buttonDisabled: buttonDisabled,
            selectedTemplates: combo_infos
        },
        methods:{
            addEquipment: function(template) {
                this.selectedTemplates.push({
                    combo_id: combo.id,
                    template_id: template.id,
                    template: template
                });
                this.buttonDisabled[template.id] = true;
            },
            removeEquipmentCard: function(index) {
                templateId = this.templates[index].id;
                this.buttonDisabled[templateId] = false;
                this.templates.splice(index, 1);
            },
        }
    });
</script>
@endsection