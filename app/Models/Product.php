<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false; // Disable automatic timestamps

    use HasFactory;

    protected $fillable = ['product_name', 'price', 'stock_s', 'stock_m', 'stock_l', 'stock_xl', 'rating'];
        // Product model
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function updateRating()
    {
        // Calculate the average rating for this product
        $averageRating = $this->userRatings()->avg('rating');  // Average of all ratings

        // Update the product's rating column
        $this->update(['rating' => $averageRating]);
    }

    /**
     * Define the relationship with the UserRating model.
     */
    public function userRatings()
    {
        return $this->hasMany(UserRating::class, 'product_id');  // Relationship with user ratings
    }
}
