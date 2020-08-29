<template>
    <!-- MultiStep Form -->
    <div class="container">
        <div class="row">
            <div class="col-lg-10 m-auto">
                <form id="msform">
                    <!-- progressbar -->
                    <div class="track">
                        <div :class="{'step': true, 'active': step >= 0}">
                            <span class="icon"> <i class="fa fa-info"></i> </span>
                            <span class="text">Thông tin đơn mượn</span>
                        </div>
                        <div :class="{'step': true, 'active': step >= 1}">
                            <span class="icon"> <i class="fa fa-desktop"></i> </span>
                            <span class="text">Chọn thiết bị</span>
                        </div>
                        <div :class="{'step': true, 'active': step >= 2}">
                            <span class="icon"> <i class="fa fa-check"></i> </span>
                            <span class="text"> Xác nhận</span>
                        </div>
                    </div>
                    <fieldset>
                        <div v-show="step==0">
                            <h2 class="fs-title">Thông tin đơn mượn</h2>
                            <h3 class="fs-subtitle">Tell us something more about you</h3>
                            <div class="form-group row">
                                <label for="guest_name" class="col-3 col-form-label text-left">Người mượn</label>
                                <div class="col-9">
                                    <input type="text" name="guest_name" id="guest_name" class="form-control" placeholder="Người mượn">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="room" class="col-3 col-form-label text-left">Phòng</label>
                                <div class="col-9">
                                    <input type="text" name="room" id="room" class="form-control" placeholder="Phòng">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="date-borrow" class="col-3 col-form-label text-left">Ngày mượn</label>
                                <div class="col-9">
                                    <input class="form-control" type="date" value="2011-08-19" id="date-borrow">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-date-input" class="col-3 col-form-label text-left">Ngày trả</label>
                                <div class="col-9">
                                    <input class="form-control" type="date" value="2011-08-19" id="example-date-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-4">
                                    <div class="form-check">
                                        <label class="form-check-label" for="long-term">
                                            <input class="form-check-input" type="checkbox" name="long_term" value="" id="long-term">
                                            Mượn lâu dài
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-show="step==1">
                            <h2 class="fs-title">Chọn thiết bị</h2>
                            <h3 class="fs-subtitle">Your presence on the social network</h3>

                            <table class="table mt-2 templateTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" scope="col" width="10%"></th>
                                        <th class="text-center" scope="col" width="50%">Tên thiết bị</th>
                                        <th class="text-center" scope="col" width="15%">Trong kho</th>
                                        <th class="text-center" scope="col" width="15%">Yêu cầu</th>
                                        <th class="text-center" scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class="text-center" scope="row"><img src="images\login-background.jpg" height=40 alt="template.name"></th>
                                        <td class="align-middle text-center">name</td>
                                        <td class="align-middle text-center">2</td>
                                        <td class="align-middle text-center">
                                            <input 
                                            class="form-control" 
                                            type="number" 
                                            name="amount" 
                                            min='0' 
                                            max='8' 
                                            >
                                        </td>

                                        <td class="align-middle text-center">
                                            <button 
                                            type="button" 
                                            class="btn btn-success btn-sm" 
                                            >
                                                <span class="fa fa-plus"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <div class="form-group">
                                                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#addEquipment">
                                                    Chọn thêm thiết bị
                                                </button>
                                                
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
                                                                <div class="row">
                                                                    <div class="dropdown col-3">
                                                                        <select class="custom-select mx-0">
                                                                            <option selected value='-1'>Loại thiết bị</option>
                                                                            <option selected value='0'>Tất cả</option>
                                                                            <option selected></option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <form class="my-2 my-lg-0 px-2">
                                                                            <div class="input-group">
                                                                                <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm" aria-label="search" aria-describedby="basic-addon2">
                                                                                <button class="btn btn-outline-primary my-2 my-sm-0" type="button"><span class="fa fa-search"></span></button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                <table class="table mt-2">
                                                                    <thead class="thead-light">
                                                                        <tr>
                                                                            <th class="text-center" scope="col" width="10%"></th>
                                                                            <th class="text-center" scope="col" width="50%">Tên thiết bị</th>
                                                                            <th class="text-center" scope="col" width="15%">Trong kho</th>
                                                                            <th class="text-center" scope="col" width="15%">Yêu cầu</th>
                                                                            <th class="text-center" scope="col"></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <th class="text-center" scope="row"></th>
                                                                            <td class="align-middle text-center"></td>
                                                                            <td class="align-middle text-center"></td>
                                                                            <td class="align-middle text-center">
                                                                                <input 
                                                                                class="form-control" 
                                                                                type="number" 
                                                                                name="amount" 
                                                                                min='0' 
                                                                                >
                                                                            </td>

                                                                            <td class="align-middle text-center">
                                                                                <button 
                                                                                type="button" 
                                                                                class="btn btn-success btn-sm" >
                                                                                    <span class="fa fa-plus"></span>
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Xong</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-show="step==2">
                            <h2 class="fs-title">Xác nhận</h2>
                            <h3 class="fs-subtitle">Your presence on the social network</h3>
                            <table class="table mt-2 templateTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" scope="col" width="10%"></th>
                                        <th class="text-center" scope="col" width="50%">Tên thiết bị</th>
                                        <th class="text-center" scope="col" width="15%">Trong kho</th>
                                        <th class="text-center" scope="col" width="15%">Yêu cầu</th>
                                        <th class="text-center" scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class="text-center" scope="row"><img src="images\login-background.jpg" height=40 alt="template.name"></th>
                                        <td class="align-middle text-center">name</td>
                                        <td class="align-middle text-center">2</td>
                                        <td class="align-middle text-center">
                                            <input 
                                            class="form-control" 
                                            type="number" 
                                            name="amount" 
                                            min='0' 
                                            max='8' 
                                            >
                                        </td>

                                        <td class="align-middle text-center">
                                            <button 
                                            type="button" 
                                            class="btn btn-success btn-sm" 
                                            >
                                                <span class="fa fa-plus"></span>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-secondary next action-button" @click="previousStep()">Previous</button>
                        <button type="button" class="btn btn-primary previous action-button" @click="nextStep()">Next</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    
</template>

<script>
export default {
    props: [
        'displayedTemplates'
    ],
    data() {
        return {
            step: 0
        };
    },
    methods: {
        nextStep: function() {
            if(this.step < 2)
                this.step ++;
        },
        previousStep: function() {
            if(this.step > 0) {
                this.step --;
            }
        }
    }
}
</script>

<style scoped>
    
    
</style>