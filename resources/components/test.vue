<template>
  <div class="container">
    <div class="row py-3">
      <a href="{{ route('equipment-template.index') }}" class="btn btn-secondary mr-auto">
        <i class="fa fa-chevron-left"></i> Quay lại
      </a>
    </div>
  </div>
</template>
<script>
export default {
  props: [],
  data() {
    return {
      mess: "Hello world",
      active: 1,
    };
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