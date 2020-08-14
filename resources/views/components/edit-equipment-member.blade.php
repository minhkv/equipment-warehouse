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
                <form action="{{ route('equipment.update', $eId) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="equipmentName"><i class="fa fa-cogs"></i> Kích thước</label>
                        <input type="text" class="form-control" name="size" value="{{ $equipment->size }}" placeholder="Kích thước">
                    </div>
                    <div class="form-group">
                        <label for="price"><i class="fa fa-money"></i> Giá nhập</label>
                        <input type="text" class="form-control" name="price" value="{{ $equipment->price }}" placeholder="Giá nhập">
                    </div>
                    <div class="form-group">
                        <label for="price"><i class="fa fa-building"></i> Nhà cung cấp</label>
                        <input type="text" class="form-control" name="supplier_id" value="{{ $equipment->supplier_id }}" placeholder="Nhà cung cấp">
                    </div>
                    <div class="form-group">
                        <label for="price"><i class="fa fa-location-arrow"></i> Vị trí</label>
                        <input type="text" class="form-control" name="location" value="{{ $equipment->location }}" placeholder="Vị Trí">
                    </div>
                    <div class="form-group">
                        <label for="price"><i class="fa fa-signal"></i> Tình trạng</label>
                        <x-star-input name="condition" id="edit-{{$eId}}" value="{{ $equipment->condition }}" />
                    </div>
                    <div class="form-group">
                        <label for="price"><i class="fa fa-clipboard"></i> Ghi chú</label>
                        <textarea class="form-control" name="note"  placeholder="Ghi chú" >{{ $equipment->note }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mb-2">Lưu thay đổi</button>
                </form>
            </div>
        
        </div>
    </div>
</div>