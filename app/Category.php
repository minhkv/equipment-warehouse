<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Equipment;
class Category extends Model
{
    protected $fillable = ['name'];
    public function templates() {
        return $this->hasMany(EquipmentTemplate::class)->where('display', 1);
    }
}
