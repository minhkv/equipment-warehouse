<template>
    <div class="container">
        <div class="row py-3">
            <a :href="equipmentTemplateIndexUrl" class="btn btn-secondary mr-auto">
                <i class="fa fa-chevron-left"></i> Quay lại
            </a>
        </div>
        <div class="row">
            <div class="col-md-4">
                <img class="w-100" :src="template.image" :alt="template.name" />
                <div class="overlay-button">
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#editImage">
                        <i class="fa fa-pencil"></i>
                    </button>
                    
                </div>
            </div>
            <div class="col-md-8">
                <h2><b>{{template.name}}</b>
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#editName">
                        <i class="fa fa-pencil"></i></button>
                </h2>
                <p><b>Số lượng thiết bị:</b> {{ template.equipments.length }}</p>
            </div>
        </div>

        <hr />
        <div class="row">
            <div class="row py-3">
                <div class="col-md-12 text-center">
                    <h2>Danh sách thiết bị</h2>
                </div>
            </div>
            <div class="row">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" scope="col" style="width: 5%">Mã</th>
                            <th class="text-center" scope="col" style="width: 15%;">Ngày nhập</th>
                            <th class="text-center" scope="col" style="width: 10%;">Giá nhập</th>
                            <th class="text-center" scope="col" style="width: 12%;">Nhà cung cấp</th>
                            <th class="text-center" scope="col" style="width: 10%;">Tình trạng</th>
                            <th class="text-center" scope="col" style="width: 10%;">Trạng thái</th>
                            <th class="text-center" scope="col" style="width: 15%;">Ghi chú</th>
                            <th class="text-center" scope="col" style="width: 2%;"></th>
                            <th class="text-center" scope="col" style="width: 4%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(equipment, index) in template.equipments" :key="equipment.id" class="cursor-pointer" >
                            <th data-toggle="modal" :data-target="'#detail' + equipment.id" class="align-middle text-center" scope="row">{{ equipment.id }}</th>
                            <td class="align-middle text-center">{{ equipment.input_date|formatDate }}</td>
                            <td class="align-middle text-center">{{ equipment.price|formatEquipmentPrice }}</td>
                            <td class="align-middle text-center">
                                <supplier-name :equipment="equipment"></supplier-name>
                            </td>
                            <td class="align-middle text-center">
                                <equipment-condition :condition="equipment.condition"></equipment-condition>
                            </td>
                            <td class="align-middle text-center">
                                <equipment-status :status="equipment.status"></equipment-status>
                            </td>
                            <td class="align-middle text-center">{{equipment.note}}</td>
                            <td class="align-middle px-0">
                                <button :disabled="equipment.status != 1" type="button" class="btn btn-primary btn-sm" data-toggle="modal" :data-target="'#editEquipment' + equipment.id">
                                    <span class="fa fa-pencil"></span>
                                </button>

                            </td>
                            <td class="align-middle px-0">
                                <button :disabled="equipment.status == 2" @click="deleteEquipment(equipment, index)" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </td>
                            
                        </tr>
                    </tbody>
                </table>
                <div class="row justify-content-center">
                    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addEquipment">
                        Thêm thiết bị
                    </button>
                </div>
            </div>
        </div>

        <modal-component id="editName" title="Chỉnh sửa tên">
            <div class="form-group">
                <label for="equipmentName">Nhập tên mới</label>
                <input type="text" class="form-control" id="equipmentName" name="name" v-model="templateName">
            </div>
            <template v-slot:footer>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" @click="updateName()">Lưu thay đổi</button>
            </template>
        </modal-component>
        <modal-component id="editImage" title="Chọn ảnh">
            <input type="file" ref="imageFile" v-on:change="handleFileUpload()" class="form-control-file"/>
            <template v-slot:footer>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" @click="updateImage()">Lưu thay đổi</button>
            </template>
        </modal-component>
        <modal-component id="addEquipment" title="Thêm thiết bị">
            <equipment-form :template="template" :suppliers="suppliers" :url="equipmentCreateUrl" method="POST" @store="addEquipment($event)" @close="closeModal('#addEquipment')"></equipment-form>
        </modal-component>
        <modal-component v-for="(equipment) in template.equipments" :key="'h' + equipment.id" :id="'detail' + equipment.id" :title="'Lịch sử thiết bị: ' + equipment.id" size="lg">
            <table class="table">
                <thead>
                    <tr>
                        <th>Mã đơn</th>
                        <th>Người mượn</th>
                        <th>Tình trạng</th>
                        <th>Trạng thái</th>
                        <th>Ngày mượn</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="info in equipment.order_infos.sort(sortOrder)" :key="info.id">
                        <td scope="row">{{ getOrder(info).id }}</td>
                        <td>{{ getOrder(info).guest_name }}</td>
                        <td><equipment-condition :condition="info.condition_received"></equipment-condition></td>
                        <td><info-status :status="info.status"></info-status></td>
                        <td>{{ getOrder(info).date_output|formatDate }}</td>
                    </tr>
                </tbody>
            </table>
            <template v-slot:footer>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </template>
        </modal-component>
        <modal-component v-for="(equipment, index) in template.equipments" :key="'e' + equipment.id" :id="'editEquipment' + equipment.id" :title="'Chỉnh sửa thiết bị: ' + equipment.id">
            <equipment-form :equipment="equipment" :suppliers="suppliers" @update="updateEquipment($event, index)" @close="closeModal('#editEquipment' + equipment.id)" method="PUT" :url="equipmentIndexUrl + '/' + equipment.id"></equipment-form>
        </modal-component>
        <div class="space" style="height: 10vh;"></div>
    </div>
</template>
<script>
    export default {
        props: [
            "equipmentTemplateIndexUrl",
            "equipmentTemplateUpdateUrl",
            "equipmentIndexUrl",
            "equipmentCreateUrl",
            "equipmentTemplate",
            "suppliers",
        ],
        data() {
            return {
                template: {},
                templateName: '',
                imageFile: "",
                file: "",
            };
        },
        created() {
            this.template = this.equipmentTemplate;
            this.templateName = this.template.name;
        },
        methods: {
            getOrder(orderInfo) {
                return orderInfo.order_request_info.order;
            },
            sortOrder(a, b) {
                let dateA = new Date(this.getOrder(a).date_output);
                let dateB = new Date(this.getOrder(b).date_output);
                return dateB.getTime() - dateA.getTime();
            },
            handleFileUpload() {
                console.log("change");
                this.imageFile = this.$refs.imageFile.files[0];
            },
            isFileImage(file) {
                return file && file["type"].split("/")[0] === "image";
            },
            validateImage() {
                if (!this.imageFile) {
                    alert("Bạn chưa chọn ảnh");
                    return;
                }
                if (!this.isFileImage(this.imageFile)) {
                    alert("File bạn chọn không phải là ảnh");
                    return;
                }
                return true;
            },
            sendUpdateTemplateRequest(formData, headers, callback) {
                formData.append("_method", "PUT");
                axios
                    .post(this.equipmentTemplateUpdateUrl, formData, headers)
                    .then(function (res) {
                        console.log(res);
                        callback(res);
                    })
                    .catch(function (err) {
                        console.log(err);
                    });
            },
            updateImage() {
                console.log("submit");
                if (!this.validateImage()) return;
                let formData = new FormData();
                let app = this;
                let headers = {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                };
                formData.append("imageFile", this.imageFile);
                this.sendUpdateTemplateRequest(formData, headers, function(res) {
                    app.template.image = res.data.image;
                    app.closeModal('#editImage');
                });
            },
            validateName() {
                if(!this.template.name) {
                    alert('Tên không được để trống');
                    return false;
                }
                return true;
            },
            updateName() {
                console.log('updateName');
                if(!this.validateName()) return;
                let formData = new FormData();
                let app = this;
                let headers = {};
                formData.append("name", this.templateName);
                this.sendUpdateTemplateRequest(formData, headers, function(res) {
                    app.template.name = res.data.name;
                    app.closeModal('#editName');
                });
            },
            addEquipment(equipment) {
                console.log('addEquipment');
                console.log(equipment);
                this.equipmentTemplate.equipments.push(equipment);
            },
            updateEquipment(newEquipment, index) {
                console.log('updateEquipment');
                console.log(newEquipment);
                Vue.set(this.template.equipments, index, newEquipment);
            },
            deleteEquipment(equipment, index) {
                console.log("deleteEquipment " + index);
                let app = this;
                axios.delete(this.equipmentIndexUrl + '/' + equipment.id)
                .then(function(res) {
                    console.log(res);
                    app.template.equipments.splice(index, 1);
                }).catch(function(err) {
                    console.log(err);
                });
            },
            displayHistory(equipment) {
                console.log(equipment.id);
                this.openModal('#newModal');
            },
            openModal(id) {
                console.log('openModal ' + id);
                setTimeout(function() {$(id).modal('show');}, 200);
            },
            closeModal(id) {
                console.log('closeModal ' + id);
                $(id).modal('toggle');
                $(".modal-backdrop").remove();
            }

        },
    };
</script>
<style scoped>
    .overlay-button {
        position: absolute;
        top: 10px;
        left: 10px;
    }
</style>