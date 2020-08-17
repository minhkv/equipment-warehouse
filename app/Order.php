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
        'date_created', 
        'date_approved', 
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
        foreach($this->orderInfos as $info) {
            $total += $info->amount;
        }
        return $total;
    }
}
