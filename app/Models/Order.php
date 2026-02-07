<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'table_id',
        'user_id',
        'total_price',
        'status'
    ];

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    public function table() {
        return $this->belongsTo(Table::class);
    }
}
