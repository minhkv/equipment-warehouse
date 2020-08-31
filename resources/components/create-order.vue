<template>
    <!-- MultiStep Form -->
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
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
<style scoped>
/*custom font*/
@import url(https://fonts.googleapis.com/css?family=Montserrat);

/*basic reset*/
* {
    margin: 0;
    padding: 0;
}

/*form styles*/
#msform {
    text-align: center;
    position: relative;
    margin-top: 30px;
}

#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0px;
    box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
    padding: 20px 30px;
    box-sizing: border-box;
    width: 80%;
    margin: 0 10%;

    /*stacking fieldsets above each other*/
    position: relative;
}

/*Hide all except first fieldset*/
#msform fieldset:not(:first-of-type) {
    display: none;
}

/*buttons*/
#msform .action-button {
    font-size: 13px;
    font-weight: bold;
    width: 100px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
    border-radius: 25px;
}

.page {
    min-height: 500px;
}

#msform .action-button:hover, #msform .action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #007bff;
}

#msform .action-button-previous {
    width: 100px;
    border: 0 none;
    border-radius: 25px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
}

#msform .action-button-previous:hover, #msform .action-button-previous:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #efefef;
}

/*headings*/
.fs-title {
    font-size: 18px;
    text-transform: uppercase;
    color: #2C3E50;
    margin-bottom: 10px;
    letter-spacing: 2px;
    font-weight: bold;
}

.fs-subtitle {
    font-weight: normal;
    font-size: 13px;
    color: #666;
    margin-bottom: 20px;
}

.templateTable, .templateTable input {
    font-size: small;
}


/* Not relevant to this form */
.dme_link {
    margin-top: 30px;
    text-align: center;
}
.dme_link a {
    background: #FFF;
    font-weight: bold;
    color: #ee0979;
    border: 0 none;
    border-radius: 25px;
    cursor: pointer;
    padding: 5px 25px;
    font-size: 12px;
}

.dme_link a:hover, .dme_link a:focus {
    background: #C5C5F1;
    text-decoration: none;
}


.track {
    position: relative;
    background-color: #ddd;
    height: 7px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    margin-bottom: 70px;
    margin-top: 50px
}

.track .step {
    -webkit-box-flex: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
    width: 25%;
    margin-top: -18px;
    text-align: center;
    position: relative
}

.track .step.active:before {
    background: #009AEB
}

.track .step::before {
    height: 7px;
    position: absolute;
    content: "";
    width: 100%;
    left: 0;
    top: 18px
}

.track .step.active .icon {
    background: #009AEB;
    color: #fff
}

.track .icon {
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    position: relative;
    border-radius: 100%;
    background: #ddd
}

.track .step.active .text {
    font-weight: 400;
    color: #000
}

.track .text {
    display: block;
    margin-top: 7px
}

</style>
<script>
export default {
    props: [
        "orderIndexUrl",
        "templates",
        "categories"
    ],
    data() {
        return {
            step: 0,
            selectedTemplates: [],
            buttonDisabled: {},
            category_id: 0,
            search: '',
            page: 1,
            perPage: 5,
            pages: [],
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
        },
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
        getSelectedTemplate: function(template_id) {
            for(i in this.selectedTemplates) {
                if(this.selectedTemplates[i].id == template_id) {
                    return this.selectedTemplates[i];
                }
            }
        },
        removeEquipmentCard: function(index) {
            templateId = this.selectedTemplates[index].id;
            this.buttonDisabled[templateId] = false;
            this.selectedTemplates.splice(index, 1);
        },
        checkZeroAmount: function(template) {
            if (template.amount == 0) {
                return true;
            }
            return false;
        },
        equipmentTemplateCategory: function(category_id, equipmentTemplateList) {
            if (category_id <= 0) return equipmentTemplateList;
            var result = equipmentTemplateList.filter(function(template) {
                return template.category_id == category_id;
            });
            return result;
        },
        submitBorrowedOrder: function() {
            console.log('submit');
            if (this.selectedTemplates.length == 0) {
                alert('Bạn chưa chọn thiết bị nào!');
                return;
            }
            for (i in this.selectedTemplates) {
                if (this.selectedTemplates[i].amount == 0) {
                    alert('Số lượng mượn của thiết bị ' + this.selectedTemplates[i].name + ' phải lớn hơn 0!');
                    return;
                }
            }
            document.getElementById('formCreateOrder').submit();
        },
    }
};
</script>