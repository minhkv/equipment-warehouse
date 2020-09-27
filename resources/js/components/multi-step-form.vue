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
                            <div class="form-group row">
                                <label for="guest_name" class="col-3 col-form-label text-left">Người mượn</label>
                                <div class="col-9">
                                    <input v-model="guestName" @blur="storeStorageValue" required type="text" name="guest_name" id="guest_name" class="form-control" placeholder="Người mượn">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="room" class="col-3 col-form-label text-left">Phòng</label>
                                <div class="col-9">
                                    <!-- <input v-model="department" @blur="storeStorageValue" required type="text" name="room" id="room" class="form-control" placeholder="Phòng"> -->
                                    <selector v-model="department" :items="channels" labelAtt="name" valueAtt="name"></selector>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dateBorrowed" class="col-3 col-form-label text-left">Ngày mượn</label>
                                <div class="col-9">
                                    <input v-model="dateBorrowed" @blur="storeStorageValue" required class="form-control" type="datetime-local" id="dateBorrowed">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dateReturn" class="col-3 col-form-label text-left">Ngày trả</label>
                                <div class="col-9">
                                    <input v-model="dateReturn" @blur="storeStorageValue" required class="form-control" type="datetime-local"  id="dateReturn">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-4">
                                    <div class="form-check">
                                        <label class="form-check-label" for="long-term">
                                            <input v-model="longTerm" @change="storeStorageValue" class="form-check-input" type="checkbox" name="long_term" id="long-term">
                                            Mượn lâu dài
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="reason" class="col-3 col-form-label text-left">Lý do mượn</label>
                                <div class="col-9">
                                    <input v-model="reason" @blur="storeStorageValue" required class="form-control" type="text"  id="reason" placeholder="Lý do mượn">
                                </div>
                            </div>
                        </div>
                        <div v-show="step==1">
                            <h2 class="fs-title">Chọn thiết bị</h2>

                            <table class="table mt-2 templateTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" scope="col" width="10%"></th>
                                        <th class="text-center" scope="col" width="50%">Tên thiết bị</th>
                                        <th class="text-center" scope="col" width="15%">Trong kho</th>
                                        <th class="text-center" scope="col" width="15%">Yêu cầu</th>
                                        <th class="text-center" scope="col" width="15%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(template, index) in selectedTemplates" :key="template.id">
                                        <th class="text-center" scope="row"><img :src="template.image" height=40 alt="template.name"></th>
                                        <td class="align-middle text-center">{{template.name}}</td>
                                        <td class="align-middle text-center">{{template.maxAmount}}</td>
                                        <td class="align-middle text-center">
                                            <input 
                                            @change="storeStorageValue();"
                                            class="form-control" 
                                            type="number" 
                                            name="amount" 
                                            min='0' 
                                            :max='template.maxAmount' 
                                            v-model="template.amount"
                                            >
                                        </td>
                                        <td class="align-middle text-center"><button @click="removeEquipmentCard(index);storeStorageValue();" type="button" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button></td>
                                    </tr>
                                    <tr v-show="selectedTemplates.length == 0">
                                        <td colspan="5">Chưa có thiết bị nào. Hãy chọn thiết bị cần mượn.</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <div class="form-group">
                                                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#addEquipment">
                                                    Chọn thiết bị
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-show="step==2">
                            <h2 class="fs-title">Xác nhận</h2>
                            <div class="row">
                                <label class="col-3 text-left">Người mượn</label>
                                <label class="col-9 text-left">{{guestName}}</label>
                            </div>
                            <div class="row">
                                <label class="col-3 text-left">Phòng</label>
                                <label class="col-9 text-left">{{ department }}</label>
                            </div>
                            <div class="row">
                                <label class="col-3 text-left">Ngày mượn</label>
                                <label class="col-9 text-left">{{ dateBorrowed|formatDate }}</label>
                            </div>
                            <div class="row">
                                <label class="col-3 text-left">Ngày trả</label>
                                <label class="col-9 text-left">{{ dateReturn|formatDate }}</label>
                            </div>
                            <div class="row">
                                <label class="col-3 text-left">Mượn lâu dài</label>
                                <label class="col-9 text-left">{{ longTerm|formatBoolean }}</label>
                            </div>
                            <div class="row">
                                <label class="col-3 text-left">Lý do mượn</label>
                                <label class="col-9 text-left">{{ reason }}</label>
                            </div>
                            
                            <table class="table mt-2 templateTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" scope="col" width="10%"></th>
                                        <th class="text-center" scope="col" width="50%">Tên thiết bị</th>
                                        <th class="text-center" scope="col" width="15%">Yêu cầu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="template in selectedTemplates" :key="template.id">
                                        <th class="text-center" scope="row"><img :src="template.image" height=40 alt="template.name"></th>
                                        <td class="align-middle text-center">{{template.name}}</td>
                                        <td class="align-middle text-center">
                                            {{template.amount}}
                                        </td>
                                    </tr>
                                    <tr v-show="selectedTemplates.length == 0">
                                        <td colspan="5">Chưa có thiết bị nào. Hãy chọn thiết bị cần mượn.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button v-show="step > 0" type="button" class="btn btn-secondary next action-button" @click="previousStep()">Quay lại</button>
                        <button v-show="step < 2" type="button" class="btn btn-primary previous action-button" @click="nextStep()">Tiếp tục</button>
                        <button v-show="step == 2" type="button" class="btn btn-success previous action-button" :disabled="submit" @click="clearStorage();submitBorrowedOrder();">Hoàn tất</button>
                    </fieldset>
                </form>
            </div>
        </div>
        <modal-component id="addEquipment" title="Thêm thiết bị" size="lg">
            <div class="row">
                <div class="dropdown col-3">
                    <!-- Select -->
                    <selection-filter
                        :items="templates"
                        :values="filterConfig.values"
                        :all="filterConfig.all"
                        :by="filterConfig.by"
                        @change="selectionFilter($event)"
                    ></selection-filter>
                </div>
                <div class="col-8">
                    <!-- Search -->
                    <search-input :items="filterItems" :by="['name']" @change="searchInput($event)"></search-input>
                </div>
            </div>
            <table class="table mt-2">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center" scope="col" width="10%"></th>
                        <th class="text-center" scope="col" width="45%">Tên thiết bị</th>
                        <th class="text-center" scope="col" width="15%">Trong kho</th>
                        <th class="text-center" scope="col" width="15%">Yêu cầu</th>
                        <th class="text-center" scope="col" width="15%"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="template in paginateItems" :key="template.id">
                        <th class="text-center" scope="row"><img :src="template.image" height=40 :alt="template.name"></th>
                        <td class="align-middle text-center">{{ template.name }}</td>
                        <td class="align-middle text-center">{{ template.equipments.length }}</td>
                        <td class="align-middle text-center">
                            <input 
                            @change="storeStorageValue();"
                            class="form-control" 
                            v-if="buttonDisabled[template.id]" 
                            type="number" 
                            name="amount" 
                            min='0' 
                            :max='template.equipments.length' 
                            v-model="getSelectedTemplate(template.id).amount"
                            >
                        </td>

                        <td class="align-middle text-center">
                            <button 
                            :disabled="buttonDisabled[template.id]" 
                            v-on:click="addEquipment(template);storeStorageValue();" 
                            type="button" 
                            class="btn btn-success btn-sm" 
                            >
                                <span class="fa fa-plus"></span>
                            </button>
                            <button 
                            :disabled="!buttonDisabled[template.id]" 
                            @click="removeEquipmentCardById(template.id);storeStorageValue();" 
                            type="button" 
                            class="btn btn-danger btn-sm">
                                <span class="fa fa-minus"></span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Paginator -->
            <div class="row justify-content-center">
                <pagination :items="searchItems" :per="6" @change="pagination($event)"></pagination>
            </div>
            <template v-slot:footer>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Xong</button>
            </template>
        </modal-component>
    </div>
</template>

<script>
export default {
    props: [
        "orderIndexUrl",
        "templates",
        "categories",
        "channels",
        "type",
        "stockerId",
        "orderCreateUrl"
    ],
    data() {
        return {
            step: 0,
            guestName: '',
            department: '',
            dateBorrowed: '',
            dateReturn: '',
            longTerm: false,
            reason: '',
            selectedTemplates: [],
            buttonDisabled: {},
            filterConfig: {
                values: [],
                all: { name: "Loại thiết bị", value: 0 },
                by: "category_id",
            },
            filterItems: [],
            searchItems: [],
            paginateItems: [],
            displayedTemplates: [],
            submit: false
        };
    },
    created() {
        this.init();
    },
    methods: {
        init() {
            this.loadStorageValue();
            this.initFilter();
        },
        initFilter() {
            this.categories.forEach((cate) => {
                this.filterConfig.values.push({
                    name: cate.name,
                    value: cate.id,
                });
            });
        },
        selectionFilter(items) {
            this.filterItems = items;
        },
        searchInput(items) {
            this.searchItems = items;
        },
        pagination(items) {
            this.paginateItems = items;
        },
        loadStorageValue() {
            if(localStorage.guestName) {
                this.guestName = localStorage.guestName;
            }
            if(localStorage.department) {
                this.department = localStorage.department;
            }
            if(localStorage.dateBorrowed) {
                this.dateBorrowed = localStorage.dateBorrowed;
            }
            if(localStorage.dateReturn) {
                this.dateReturn = localStorage.dateReturn;
            }
            if(localStorage.longTerm) {
                this.longTerm = (localStorage.longTerm == 'true');
            }
            if(localStorage.reason) {
                this.reason = localStorage.reason;
            }
            if(localStorage.buttonDisabled) {
                this.buttonDisabled = JSON.parse(localStorage.buttonDisabled);
            }
            if(localStorage.selectedTemplates) {
                this.selectedTemplates = JSON.parse(localStorage.selectedTemplates);
            }
        },
        storeStorageValue() {
            localStorage.guestName = this.guestName;
            localStorage.department = this.department;
            localStorage.dateBorrowed = this.dateBorrowed;
            localStorage.dateReturn = this.dateReturn;
            localStorage.longTerm = this.longTerm;
            localStorage.reason = this.reason;
            localStorage.buttonDisabled = JSON.stringify(this.buttonDisabled);
            localStorage.selectedTemplates = JSON.stringify(this.selectedTemplates);
        },
        clearStorage() {
            localStorage.clear();
        },
        validate() {
            if(this.step == 0) {
                if(this.guestName == '') {
                    alert('Người mượn không được để trống');
                    return false;
                };
                if(this.department == '') {
                    alert('Phòng không được để trống');
                    return false;
                }
                if(this.dateBorrowed == '') {
                    alert('Ngày mượn không được để trống');
                    return false;
                }
                if(this.dateReturn == '') {
                    alert('Ngày trả không được để trống');
                    return false;
                }
                let db = new Date(this.dateBorrowed);
                let dr = new Date(this.dateReturn);
                if(db.getTime() > dr.getTime()) {
                    alert('Ngày trả phải sau ngày mượn');
                    return false;
                }
            }
            if(this.step == 1) {
                if(this.selectedTemplates.length == 0) {
                    alert('Bạn chưa chọn thiết bị nào. Hãy chọn thiết bị.');
                    return false;
                }
                for(let i in this.selectedTemplates) {
                    if (this.selectedTemplates[i].amount == 0) {
                        alert('Số lượng mượn của thiết bị "' + this.selectedTemplates[i].name + '" phải lớn hơn 0.');
                        return false;
                    }
                }
            }
            return true;
        },
        nextStep: function() {
            if(!this.validate()) return;
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
            for(let i in this.selectedTemplates) {
                if(this.selectedTemplates[i].id == template_id) {
                    return this.selectedTemplates[i];
                }
            }
        },
        removeEquipmentCard: function(index) {
            let templateId = this.selectedTemplates[index].id;
            this.buttonDisabled[templateId] = false;
            this.selectedTemplates.splice(index, 1);
        },
        removeEquipmentCardById: function(id) {
            let index = this.selectedTemplates.findIndex(x => x.id == id);
            this.buttonDisabled[id] = false;
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
            this.submit = true;
            axios.post(this.orderCreateUrl, {
                type: this.type,
                stockerId: this.stockerId,
                guestName: this.guestName,
                department: this.department,
                dateBorrowed: this.dateBorrowed,
                dateReturn: this.dateReturn,
                longTerm: this.longTerm,
                reason: this.reason,
                templates: this.selectedTemplates
            })
            .then(res => {
                console.log(res);
                window.location.replace(res.data);
            }).catch(err => {
                console.log(err);
            });

        },
    }
};
</script>

<style scoped>
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
    
</style>