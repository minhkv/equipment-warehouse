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
}
