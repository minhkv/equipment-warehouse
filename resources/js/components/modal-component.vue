<template>
    <div>
        <!-- Modal -->
        <div class="modal fade" :id="id" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div :class="modalDialogClass()" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{title}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <slot></slot>
                    </div>
                    <div v-if="hasFooter()" class="modal-footer">
                        <slot name="footer"></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['id', 'title', 'size'],
    methods: {
        hasFooter() {
            return this.$slots.footer;
        },
        modalDialogClass() {
            return {
                'modal-dialog': true,
                'modal-xl': this.size == 'xl',
                'modal-lg': this.size == 'lg',
                'modal-sm': this.size == 'sm'
            };
        }
    }
}
</script>
<style scoped>

</style>