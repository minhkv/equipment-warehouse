<!-- Add equipment -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addEquipment">
    <span class="fa fa-plus"></span>
</button>

<!-- Modal -->
<div class="modal fade" id="addEquipment" tabindex="-1" role="dialog" aria-labelledby="addEquipmentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEquipmentLabel">Thêm thiết bị</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('equipment.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="template_id" value="{{ $templateId }}">
                    <!-- <div class="form-group">
                        <label for="equipmentName"><i class="fa fa-barcode"></i> Mã</label>
                        <input type="text" class="form-control" name="id" placeholder="Mã">
                    </div> -->
                    <div class="form-group">
                        <label for="equipmentName"><i class="fa fa-cogs"></i> Kích thước</label>
                        <input type="text" class="form-control" name="size" placeholder="Kích thước">
                    </div>
                    <div class="form-group">
                        <label for="price"><i class="fa fa-money"></i> Giá nhập</label>
                        <input type="text" class="form-control" name="price"  placeholder="Giá nhập">
                    </div>
                    <div class="form-group">
                        <label for="price"><i class="fa fa-home"></i> Nhà cung cấp</label>
                        <input type="text" class="form-control" name="supplier" placeholder="Nhà cung cấp">
                    </div>
                    <div class="form-group">
                        <label for="price"><i class="fa fa-location-arrow"></i> Vị trí</label>
                        <input type="text" class="form-control" name="location" placeholder="Vị Trí">
                    </div>
                    <div class="form-group">
                        <label for="price"><i class="fa fa-signal"></i> Tình trạng</label>
                        <input type="text" class="form-control" name="condition" placeholder="Tình trạng">
                    </div>

                    <button type="submit" class="btn btn-primary mb-2">Thêm thiết bị</button>
                </form>
            </div>
        
        </div>
    </div>
</div>