<template>
    <h3>{{getTitle()}}</h3>
</template>
<script>
export default {
    props: ['status'],
    methods: {
        getTitle() {
            switch(this.status) {
                case -1:
                    return 'Từ chối';
                case 0:
                    return 'Duyệt đơn';
                case 1:
                    return 'Chọn đồ';
                case 2:
                    return 'Kiểm đồ';
                case 3:
                    return 'Hoàn tất';
                case 4:
                    return 'Hoàn tất';
            }
        }
    }
}
</script>