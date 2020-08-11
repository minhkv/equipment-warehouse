<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Equipment;
class Category extends Model
{
    protected $fillable = ['name'];
    public function equipments() {
        return $this->hasMany(Equipment::class);
    }
}
