<template>
    <div class="v-autocomplete">
        <div class="v-autocomplete-input-group">
            <input
                v-model="search"
                @keyup="keyup"
                @focus="focus"
                @blur="blur"
                :placeholder="placeholder"
                type="search"
                class="form-control"

            />
        </div>
        <div class="v-autocomplete-list" v-if="show">
            <div
                class="v-autocomplete-list-item"
                v-for="(item, index) in displayedItems"
                :key="index"
                @click="changeInput(item[nameAttribute])"
            >{{item[nameAttribute]}}</div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["items", "nameAttribute", "placeholder", "value"],
    data() {
        return {
            displayedItems: [],
            show: false,
            search: "",
            found: {},
        };
    },
    created() {
        this.displayedItems = this.items;
        if (!this.nameAttribute) {
            this.nameAttribute = "name";
        }
        if(this.value) {
            this.search = this.value;
        }
    },
    methods: {
        normalizeSearchString(str) {
            return str
                .normalize("NFD")
                .replace(/[\u0300-\u036f]/g, "")
                .toLowerCase();
        },
        searchInput() {
            this.displayedItems = this.items.filter((x) => {
                var name = this.normalizeSearchString(x[this.nameAttribute]);
                var search = this.normalizeSearchString(this.search);
                return name.includes(search);
            });
            this.found = this.items.find(x => {
                return x[this.nameAttribute] === this.search;
            });
        },
        sendChangeEvent() {
            let result = {
                found: this.found != undefined,
                value: this.found ? this.found : {name: this.search}
            };
            this.$emit("change", result);
        },
        focus() {
            this.show = true;
        },
        blur() {
            setTimeout(() => (this.show = false), 200);
        },
        keyup() {
            this.searchInput();
            this.sendChangeEvent();
        },
        changeInput(text) {
            this.search = text;
            this.searchInput();
            this.sendChangeEvent();
        },
    },
};
</script>
<style scoped>
.v-autocomplete {
    position: relative;
}

.v-autocomplete .v-autocomplete-list {
    position: absolute;
    background: white;
    width: 100%;
    text-align: left;
    border: none;
    border-top: none;
    max-height: 400px;
    overflow-y: auto;
    z-index: 10;
}

.v-autocomplete .v-autocomplete-list .v-autocomplete-list-item {
    cursor: pointer;
    background-color: #fff;
    padding: 10px;
}

.v-autocomplete
    .v-autocomplete-list
    .v-autocomplete-list-item.v-autocomplete-item-active {
    background-color: #f3f6fa;
}

.v-autocomplete-list .v-autocomplete-list-item:hover {
    background-color: #eee;
}
</style>