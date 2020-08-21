<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Supplier;
class Equipment extends Model
{
    protected $table="equipments";
    protected $fillable = [
        'template_id',
        'price', 
        'size',
        'supplier',
        'location',
        'condition',
        'note',
        'input_date',
        'warranty'
    ];
    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }
    public function getStatusAttribute($value) {
        switch($value) {
            case 0:
                return "Thất lạc";
            case 1:
                return "Sẵn sàng";
            case 2:
                return "Đang cho mượn";
        }
    }
}
