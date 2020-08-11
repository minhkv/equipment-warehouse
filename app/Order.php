<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OrderInfo;
class Order extends Model
{
    protected $fillable = [
        'type', 
        'date_created', 
        'date_approved', 
        'date_completed', 
        'due_date',
        'reason',
        'status',
        'comment',
    ];
    public function orderInfos() {
        return this->hasMany(OrderInfo::class);
    }

}
