<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table="equipments";
    protected $fillable = [
        'price', 
        'size',
        'location',
        'condition',
        'input_date',
        'warranty'
    ];
}
