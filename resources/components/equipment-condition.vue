<template>
    <div :class="equipmentConditionClass()">
        <span>
            {{ condition|formatEquipmentCondition }} 
            <i v-if="condition >= 2" class="fa fa-check-circle" aria-hidden="true"></i>
            <i v-if="condition == 1" class="fa fa-check" aria-hidden="true"></i>
            <i v-if="condition == 0" class="fa fa-exclamation-triangle" aria-hidden="true"></i>
        </span>
    </div>
</template>
<script>
export default {
    props: ['condition', ],
    methods: {
        equipmentConditionClass() {
            return {
                'font-weight-bold': true,
                'text-success': this.condition >= 2,
                'text-primary': this.condition == 1,
                'text-danger': this.condition == 0,
            }
        }
    }
};
</script>
<style scoped>
</style>