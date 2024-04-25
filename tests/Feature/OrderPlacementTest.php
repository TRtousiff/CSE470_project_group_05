<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\UserCart;
use App\Models\Product;
use App\Models\PlacedOrder;
use Illuminate\Support\Facades\Log;

class OrderPlacementTest extends TestCase
{

    public function test_order_placement_creates_placed_order()
    {
        // Create a test user
        $user = User::factory()->create();

        // Create a test product
        $product = Product::factory()->create([
            'price' => 20.00,  // Set a specific price for the product
        ]);

        // Add an item to the user's cart
        $cartItem = UserCart::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2,  // Set quantity
            'size' => 'M',  // Example size
        ]);

        // Simulate authentication
        $this->actingAs($user);

        // Simulate form data for the order
        $formData = [
            'receiver_name' => 'John Doe',
            'phone_number' => '1234567890',
            'address' => '123 Test St',
            'payment_method' => 'Cash on Delivery',
            'cart_ids' => [$cartItem->id],  // Reference the cart item
        ];

        // Send a POST request to the place order route
        $response = $this->post(route('place.order'), $formData);

        // Assert that the response redirects (successful order placement)
        $response->assertRedirect(route('order.success'));

        // Assert that a new placed order was created
        $this->assertDatabaseHas('placed_orders', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2,  // Ensure correct quantity
            'size' => 'M',  // Ensure correct size
            'receiver_name' => 'John Doe',
            'phone_number' => '1234567890',
            'address' => '123 Test St',
        ]);

        // Assert that the cart item was removed from the user's cart
        $this->assertDatabaseMissing('user_carts', [
            'id' => $cartItem->id,
        ]);
    }
}
