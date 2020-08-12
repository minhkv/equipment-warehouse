<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        'input_date',
        'warranty'
    ];
}
