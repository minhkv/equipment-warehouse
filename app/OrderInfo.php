<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Equipment;
use App\OrderRequestInfo;

class OrderInfo extends Model
{
    protected $table = 'order_info';
    protected $fillable = [
        'equipment_id',
        'condition_before',
        'condition_received',
        'status',
        'date_received',
        'note',
    ];
    public function equipment() {
        return $this->belongsTo(Equipment::class);
    }
    public function orderRequestInfo() {
        return $this->belongsTo(OrderRequestInfo::class, 'request_id', 'id');
    }
}
