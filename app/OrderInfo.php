<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderInfo extends Model
{
    protected $table = 'order_info';
    protected $fillable = [
        'template_id',
        'status',
        'date_received',
        'comment',
    ];
}
