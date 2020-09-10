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
        'supplier_id',
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
    // public function getPriceAttribute($value) {
    //     return number_format($value).' đ';
    // }
}
