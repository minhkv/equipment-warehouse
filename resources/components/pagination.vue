<template>
    <nav>
        <ul class="pagination">
            <li :class="previousClass()">
                <button
                    class="page-link"
                    href="#"
                    :disabled="page <= 1"
                    @click="previous"
                >Previous</button>
            </li>
            <li :class="linkClass(pageNumber)" v-for="pageNumber in pages.slice(page-1, page+5)" :key="pageNumber">
                <a
                    href="#"
                    @click="selectPage(pageNumber)"
                    class="page-link"
                >{{pageNumber}}</a>
            </li>
            <li :class="nextClass()">
                <button
                    class="page-link"
                    href="#"
                    @click="next"
                    :disabled="page >= pages.length"
                >Next</button>
            </li>
        </ul>
    </nav>
</template>
<script>
export default {
    props: ["items"],
    data() {
        return {
            page: 1,
            perPage: 12,
            pages: [],
        };
    },
    created() {
        this.init();
    },
    watch: {
        items: function () {
            this.update();
        },
    },
    methods: {
        init() {
            this.setPages();
            this.sendEvent();
        },
        update() {
            this.setPages();
            this.sendEvent();
        },
        setPages() {
            let numberOfPages = Math.ceil(this.items.length / this.perPage);
            this.page = 1;
            this.pages = [];
            for (let index = 1; index <= numberOfPages; index++) {
                this.pages.push(index);
            }
        },
        paginate(itemList) {
            let page = this.page;
            let from = page * this.perPage - this.perPage;
            let to = page * this.perPage;
            return itemList.slice(from, to);
        },
        previousClass() {
            return {
                "page-item": true,
                "disabled": this.page <= 1
            };
        },
        nextClass() {
            return {
                "page-item": true,
                "disabled": this.page >= this.pages.length
            };
        },
        linkClass(pageNumber) {
            return {
                "page-item": true,
                "active": this.page == pageNumber,
            };
        },
        selectPage(pageNumber) {
            this.page = pageNumber;
            this.sendEvent();
        },
        previous() {
            this.page--;
            this.sendEvent();
        },
        next() {
            this.page++;
            this.sendEvent();
        },
        sendEvent() {
            console.log("pagination");
            this.$emit("change", this.paginate(this.items));
        },
    },
};
</script>
<style scoped>
</style>