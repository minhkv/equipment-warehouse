<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EquipmentTemplate;

class OrderInfo extends Model
{
    protected $table = 'order_info';
    protected $fillable = [
        'equipment_id',
        'status',
        'date_received',
        'note',
    ];
    public function template() {
        return $this->belongsTo(EquipmentTemplate::class);
    }
}
