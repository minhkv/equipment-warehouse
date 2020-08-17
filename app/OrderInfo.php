<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EquipmentTemplate;

class OrderInfo extends Model
{
    protected $table = 'order_info';
    protected $fillable = [
        'template_id',
        'equipment_id',
        'status',
        'date_received',
        'comment',
    ];
    public function template() {
        return $this->belongsTo(EquipmentTemplate::class);
    }
}
