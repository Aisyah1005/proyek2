<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'total_price',
        'payment_status',
        'payment_token',
        'payment_url',
        'product_id', // Pastikan ditambahkan di fillable
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}