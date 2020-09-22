<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Equipment;
use App\Category;
class EquipmentTemplate extends Model
{
    protected $fillable = [
        'name', 'image', 'category_id'
    ];
    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function equipments() {
        return $this->hasMany(Equipment::class, 'template_id');
    }
    public function getLostEquipments() {
        $lostEquipments = $this->equipments()->where('status', 0)->get();
        return $lostEquipments;
    }
    public function hasLostEquipments() {
        return $this->equipments()->where('status', 0)->exists();
    }
}
