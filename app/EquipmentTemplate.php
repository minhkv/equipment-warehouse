<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Equipment;
use App\Category;
class EquipmentTemplate extends Model
{
    protected $fillable = [
        'name', 'image', 'category_id', 'display'
    ];
    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function equipments() {
        return $this->hasMany(Equipment::class, 'template_id')->where('display', 1);
    }
    public function lostEquipments() {
        $this->hasMany(Equipment::class, 'template_id')->where([['display', 1], ['status', 0]]);
    }
    public function hasLostEquipments() {
        return $this->equipments()
        ->where([['status', 0],['display', 1]])
        ->exists();
    }
}
