<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EquipmentTemplate;
use App\OrderInfo;

class OrderRequestInfo extends Model
{
    protected $fillable = ['template_id', 'amount', 'borrowed_amount'];
    public function template() {
        return $this->belongsTo(EquipmentTemplate::class, 'template_id', 'id');
    }
    public function orderInfos() {
        return $this->hasMany(OrderInfo::class, 'request_id', 'id');
    }
    public function order() {
        return $this->belongsTo(Order::class);
    }
}
