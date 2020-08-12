<script>
var modalConfirm = function(callback){
  
    $("#btn-confirm").on("click", function(){
        $("#mi-modal").modal('show');
    });

    $("#modal-btn-si").on("click", function(){
        callback(true);
        $("#mi-modal").modal('hide');
    });
    
    $("#modal-btn-no").on("click", function(){
        callback(false);
        $("#mi-modal").modal('hide');
    });
};

modalConfirm(function(confirm){
    if(confirm){
        //Acciones si el usuario confirma
        $("#result").html("CONFIRMED");
    }else{
        //Acciones si el usuario no confirma
        $("#result").html("NOT CONFIRMED");
    }
});
</script>
<button class="btn btn-default" id="btn-confirm">Confirm</button>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
<div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" id="modal-btn-si">Yes</button>
        <button type="button" class="btn btn-primary" id="modal-btn-no">No</button>
    </div>
    </div>
</div>
</div>

<div class="alert" role="alert" id="result"></div>