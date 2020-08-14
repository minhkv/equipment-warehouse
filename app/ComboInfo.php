<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EquipmentTemplate;
class ComboInfo extends Model
{
    protected $table = 'combo_info';
    protected $fillable = ['template_id', 'combo_id', 'amount'];

    public function template() {
        return $this->belongsTo(EquipmentTemplate::class);
    }
}
