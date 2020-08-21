<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Equipment;

class OrderInfo extends Model
{
    protected $table = 'order_info';
    protected $fillable = [
        'equipment_id',
        'status',
        'date_received',
        'note',
    ];
    public function equipment() {
        return $this->belongsTo(Equipment::class);
    }
}
