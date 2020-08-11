<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderInfo extends Model
{
    protected $fillable = [
        'status',
        'date_received',
        'comment',
    ];
}
