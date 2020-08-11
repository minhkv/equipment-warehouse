<!-- Add equipment -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#{{'editEquipment'.$eId}}">
    <span class="fa fa-pencil"></span>
</button>

<!-- Modal -->
<div class="modal fade" id="{{'editEquipment'.$eId}}" tabindex="-1" role="dialog" aria-labelledby="addEquipmentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addEquipmentLabel">Chỉnh sửa thiết bị</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form>
                @csrf
                <div class="form-group">
                    <label for="equipmentName"><i class="fa fa-barcode"></i> Mã</label>
                    <input type="text" class="form-control" id="equipmentName" placeholder="Mã">
                </div>
                <div class="form-group">
                    <label for="equipmentName"><i class="fa fa-cogs"></i> Kích thước</label>
                    <input type="text" class="form-control" id="equipmentName" placeholder="Kích thước">
                </div>
                <div class="form-group">
                    <label for="price"><i class="fa fa-money"></i> Giá nhập</label>
                    <input type="text" class="form-control" id="price" placeholder="Giá nhập">
                </div>
                <div class="form-group">
                    <label for="price"><i class="fa fa-home"></i> Nhà cung cấp</label>
                    <input type="text" class="form-control" id="price" placeholder="Nhà cung cấp">
                </div>
                <div class="form-group">
                    <label for="price"><i class="fa fa-location-arrow"></i> Vị trí</label>
                    <input type="text" class="form-control" id="price" placeholder="Vị Trí">
                </div>
                <div class="form-group">
                    <label for="price"><i class="fa fa-signal"></i> Tình trạng</label>
                    <input type="text" class="form-control" id="price" placeholder="Tình trạng">
                </div>

                <button type="submit" class="btn btn-primary mb-2">Lưu thay đổi</button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
</div>