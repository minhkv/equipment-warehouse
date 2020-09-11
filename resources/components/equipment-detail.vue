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
                    <div class="modal fade" id="editImage" tabindex="-1" role="dialog" aria-labelledby="editImageLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <input type="file" ref="imageFile" v-on:change="handleFileUpload()" />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    <button type="button" class="btn btn-primary" @click="updateImage()">Lưu thay đổi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <h2><b>{{template.name}}</b>
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#editName">
                        <i class="fa fa-pencil"></i></button>
                </h2>
                <p><b>Số lượng thiết bị:</b> {{ template.equipments.length }}</p>
                <div class="modal fade" id="editName" tabindex="-1" role="dialog" aria-labelledby="editNameLabel"
                        aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">&times;</button>
                            </div>
                            <div class="modal-body">            
                                <div class="form-group">
                                    <label for="equipmentName">Nhập tên mới</label>
                                    <input type="text" class="form-control" id="equipmentName" name="name" :value="template.name">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button type="button" class="btn btn-primary" @click="updateName()">Lưu thay đổi</button>
                            </div>
                        </div>
                    </div>
                </div>
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
                            <th class="text-center" scope="col" style="width: 10%;">Kích thước</th>
                            <th class="text-center" scope="col" style="width: 10%;">Giá nhập</th>
                            <th class="text-center" scope="col" style="width: 12%;">Nhà cung cấp</th>
                            <th class="text-center" scope="col" style="width: 8%;">Vị trí</th>
                            <th class="text-center" scope="col" style="width: 10%;">Tình trạng</th>
                            <th class="text-center" scope="col" style="width: 10%;">Trạng thái</th>
                            <th class="text-center" scope="col" style="width: 15%;">Ghi chú</th>
                            <th class="text-center" scope="col" style="width: 2%;"></th>
                            <th class="text-center" scope="col" style="width: 4%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(equipment, index) in template.equipments" :key="equipment.id">
                            <th class="align-middle text-center" scope="row">{{ equipment.id }}</th>
                            <td class="align-middle text-center">{{ equipment.size}}</td>
                            <td class="align-middle text-center">{{ equipment.price }}</td>
                            <td class="align-middle text-center">
                                {{ equipment.supplier.name }}
                            </td>
                            <td class="align-middle text-center">{{ equipment.location }}</td>
                            <td class="align-middle text-center">
                                {{ equipment.condition|formatEquipmentCondition }}
                            </td>
                            <td class="align-middle text-center">
                                <equipment-status :status="equipment.status"></equipment-status>
                            </td>
                            <td class="align-middle text-center">{{equipment.note}}</td>
                            <td class="align-middle px-0">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" :data-target="'#editEquipment' + equipment.id">
                                    <span class="fa fa-pencil"></span>
                                </button>

                                <div class="modal fade" :id="'editEquipment' + equipment.id" tabindex="-1" role="dialog" aria-labelledby="addEquipmentLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addEquipmentLabel">Chỉnh sửa thiết bị</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <equipment-form :equipment="equipment" @update="updateEquipment($event, index)" @close="closeModal('#editEquipment' + equipment.id)" method="PUT" :url="equipmentIndexUrl + '/' + equipment.id"></equipment-form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                            <td class="align-middle px-0">

                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row justify-content-center">
                    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addEquipment">
                        Thêm thiết bị
                    </button>

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
                                    <equipment-form :template="template" :url="equipmentCreateUrl" method="POST" @store="addEquipment($event)" @close="closeModal('#addEquipment')"></equipment-form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
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
                imageFile: "",
                file: "",
            };
        },
        created() {
            this.template = this.equipmentTemplate;
        },
        methods: {
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
            updateImage() {
                console.log("submit");
                if (!this.validateImage()) return;
                let formData = new FormData();
                formData.append("_method", "PUT");
                formData.append("imageFile", this.imageFile);
                axios
                    .post(this.equipmentTemplateUpdateUrl, formData, {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    })
                    .then(function (res) {
                        console.log(res);
                    })
                    .catch(function (err) {
                        console.log(err);
                    });
                this.template.image = "/storage/img/" + this.imageFile.name;
            },
            updateName() {
                console.log('updateName');
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