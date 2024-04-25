<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCart;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Retrieve cart items for the current user
        $cartItems = UserCart::where('user_id', $user->id)->get();

        return view('cart', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        $userId = auth()->id();
        if (!$userId) {
            return redirect()->route('login')->with('error', 'You must be logged in to add items to the cart.');
        }

        $product = Product::find($request->input('product_id'));
        $size = $request->input('size'); // Ensure 'size' is obtained from the request
        $quantity = intval($request->input('quantity'));

        // Check if the item is already in the cart
        $cartItem = UserCart::where('user_id', $userId)
                            ->where('product_id', $product->id)
                            ->where('size', $size) // Match the size
                            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity; // Update quantity
            $cartItem->save();
        } else {
            // Create new cart item with the given size
            UserCart::create([
                'user_id' => $userId,
                'product_id' => $product->id,
                'size' => $size, // Ensure size is saved
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    public function deleteCartItem($id)
    {
        $cartItem = UserCart::findOrFail($id);
        $cartItem->delete();

        return redirect()->back()->with('success', 'Item removed successfully.');
    }
}
