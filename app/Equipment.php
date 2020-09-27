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
        'name',
        'price', 
        'size',
        'supplier_id',
        'supplier_name',
        'location',
        'condition',
        'status',
        'note',
        'input_date',
        'warranty',
        'display'
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

}
