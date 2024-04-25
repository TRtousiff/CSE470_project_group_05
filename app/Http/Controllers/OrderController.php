<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlacedOrder;
use App\Models\UserCart;
use Illuminate\Support\Facades\Log;
use Exception;

class OrderController extends Controller
{
    public function showShipmentInfo() {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Fetch cart items for the current user
        $cartItems = UserCart::where('user_id', $user->id)->get();

        return view('shipment_info', ['user' => $user], compact('cartItems')); // Ensure cartItems is passed to the view
    }

    public function placeOrder(Request $request)
    {
        Log::info("Entered the placeOrder method.");

        try {
            // Validate input data
            $validated = $request->validate([
                'receiver_name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:255',
                'address' => 'required|string',
                'payment_method' => 'required|string',
                'name_on_card' => 'nullable|required_if:payment_method,Card|string|max:255',
                'card_number' => 'nullable|required_if:payment_method,Card|numeric',
                'card_exp_date' => 'nullable|required_if:payment_method,Card|date_format:m/y',
                'cvv' => 'nullable|required_if:payment_method,Card|numeric',
            ]);

            Log::info("Validation passed.");

            // Retrieve cart items by IDs
            $cartItems = UserCart::whereIn('id', $request->input('cart_ids', []))->get();

            if ($cartItems->isEmpty()) {
                Log::error("No cart items found.");
                return redirect()->back()->withErrors(['cart' => 'No items in the cart.']);
            }

            // Create a new order for each cart item
            foreach ($cartItems as $item) {
                Log::info("Processing order for cart item with product ID: " . $item->product_id);

                // Calculate the total price based on product price and quantity
                $totalPrice = $item->product->price * $item->quantity;

                $order = new PlacedOrder([
                    'user_id' => $item->user_id,
                    'product_id' => $item->product_id,
                    'size' => $item->size,
                    'quantity' => $item->quantity,
                    'total_price' => $totalPrice,
                    'receiver_name' => $validated['receiver_name'],
                    'phone_number' => $validated['phone_number'],
                    'address' => $validated['address'],
                    'payment_method' => $validated['payment_method'],
                    'name_on_card' => $validated['payment_method'] === 'Card' ? $validated['name_on_card'] : null,
                    'card_number' => $validated['payment_method'] === 'Card' ? $validated['card_number'] : null,
                    'card_exp_date' => $validated['payment_method'] === 'Card' ? $validated['card_exp_date'] : null,
                    'cvv' => $validated['payment_method'] === 'Card' ? $validated['cvv'] : null,
                ]);

                // Save the order to the database
                $order->save();

                Log::info("Order placed successfully for product ID: " . $item->product_id);
            }

            // Clear the corresponding cart items after order placement
            UserCart::destroy($request->input('cart_ids', []));

            Log::info("Cart cleared after order placement.");

            // Redirect to the order success page
            return redirect()->route('order.success');

        } catch (Exception $e) {
            Log::error("An error occurred while placing the order: " . $e->getMessage());
            return redirect()->back()->withErrors(['order' => 'An error occurred while placing the order.']);
        }
    }

    public function orderSuccess()
    {
        return view('order_success'); // Confirm that this view exists
    }
}
