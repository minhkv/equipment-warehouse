<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Supplier;
use App\EquipmentTemplate;

class Equipment extends Model
{
    protected $table="equipments";
    protected $fillable = [
        'template_id',
        'price', 
        'size',
        'supplier',
        'location',
        'condition',
        'status',
        'note',
        'input_date',
        'warranty'
    ];
    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }
    public function template() {
        return $this->belongsTo(EquipmentTemplate::class);
    }
    public function orderInfos() {
        return $this->hasMany(OrderInfo::class);
    }
    public function getRecentOrderInfo() {
        return $this->orderInfos()->with('orderRequestInfo', 'orderRequestInfo.order', 'orderRequestInfo.order.guest')->orderBy('created_at', 'desc')->first();
    }
    public function getStatusPretty() {
        switch($this->status) {
            case 0:
                echo '<span class="badge badge-pill badge-danger">Thất lạc</span>';
                return;
            case 1:
                echo '<span class="badge badge-pill badge-success">Sẵn sàng</span>';
                return;
            case 2:
                echo '<span class="badge badge-pill badge-primary">Đang cho mượn</span>';
                return;
        }
    }
}