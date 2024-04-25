<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserRating extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'rating'];

    public function user()
    {
        return $this->belongsTo(User::class);  // Defines relationship with User model
    }

    public function product()
    {
        return $this->belongsTo(Product::class);  // Defines relationship with Product model
    }
}
