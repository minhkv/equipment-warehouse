<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EquipmentTemplate;

class OrderRequestInfo extends Model
{
    protected $fillable = ['template_id', 'amount'];
    public function template() {
        return $this->belongsTo(EquipmentTemplate::class, 'template_id', 'id');
    }
}
