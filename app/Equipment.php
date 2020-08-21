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
    public function getStatusPretty() {
        switch($this->status) {
            case 0:
                echo '<span class="badge badge-pill badge-danger">Thất lạc</span>';
                return;
            case 1:
                echo '<span class="badge badge-pill badge-success">Sẵn sàng</span>';
                return;
            case 2:
                echo '<span class="badge badge-pill badge-primary">Đang cho mượn</span>';
                return;
        }
    }
}
