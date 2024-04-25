<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlacedOrder extends Model
{
    protected $table = 'placed_orders';

    protected $fillable = [
        'user_id', 'product_id', 'quantity', 'total_price', 'receiver_name',
        'phone_number', 'address', 'payment_method', 'name_on_card', 'card_number',
        'card_exp_date', 'cvv', 'size'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
