export default {
    methods: {
        closeModal(id) {
            console.log('closeModal ' + id);
            $(id).modal('toggle');
            $(".modal-backdrop").remove();
        }
    }
}