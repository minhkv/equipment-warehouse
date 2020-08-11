<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ComboInfo;
class Combo extends Model
{
    protected $fillable = ['name'];
    
    public function comboInfos() {
        return $this->hasMany(ComboInfo::class, 'combo_id');
    }
}
