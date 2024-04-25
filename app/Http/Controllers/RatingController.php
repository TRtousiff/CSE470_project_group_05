<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserRating;
use App\Models\Product;

class RatingController extends Controller
{
    /**
     * Submit or update a user rating for a product.
     */
    public function submitRating(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_rating' => 'required|integer|between:1,5',
        ]);

        $productId = $validated['product_id'];
        $rating = $validated['user_rating'];

        // Update or create the user rating for the product
        UserRating::updateOrCreate(
            ['user_id' => $user->id, 'product_id' => $productId],
            ['rating' => $rating]
        );

        // Get the product and update its rating
        $product = Product::find($productId);
        $product->updateRating();  // Call the method to update the average rating

        return response()->json(['success' => true]);
    }

    /**
     * Show the product detail page.
     */
    public function showProductDetail($productId)
    {
        $product = Product::findOrFail($productId);
        $userRating = null;

        if ($product) {
            $user = Auth::user();  // Get the current user

            if ($user) {  // If the user is logged in
                // Get the user's existing rating for this product
                $userRating = UserRating::where('product_id', $productId)
                                         ->where('user_id', $user->id)
                                         ->value('rating');
            }
        }

        // Return the view with the product and userRating data
        return view('product_detail', ['product' => $product], compact('userRating', 'product'));



    }
}
