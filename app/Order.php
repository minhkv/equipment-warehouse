<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OrderInfo;
use App\OrderRequestInfo;

class Order extends Model
{
    protected $fillable = [
        'type', 
        'stocker_id',
        'guest_id',
        'guest_name',
        'department',
        'date_borrowed',
        'date_return',
        'long_term',
        'date_created', 
        'date_approved', 
        'date_output',
        'date_received',
        'date_completed', 
        'due_date',
        'reason',
        'status',
        'comment',
    ];
    public function orderInfos() {
        return $this->hasMany(OrderInfo::class);
    }
    public function orderRequestInfos() {
        return $this->hasMany(OrderRequestInfo::class);
    }
    public function stocker() {
        return $this->belongsTo(User::class, 'stocker_id', 'id');
    }
    public function guest() {
        return $this->belongsTo(User::class, 'guest_id', 'id');
    }
    public function getTotalRequestAmount() {
        $total = 0;
        foreach($this->orderRequestInfos as $info) {
            $total += $info->amount;
        }
        return $total;
    }
    public function getTotalBorrowedAmount() {
        $total = 0;
        foreach($this->orderRequestInfos as $orderRequestInfo) {
            foreach($orderRequestInfo->orderInfos as $orderInfo) {
                $total += 1;
            }
        }
        return $total;
    }

}
