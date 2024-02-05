<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;



class CartSeeder extends Seeder
{
    public function run()
    {
        // Get all users from the database
        $users = User::all();

        // Create random carts for each user
        $users->each(function ($user) {
            $cart = Cart::factory()->create(['user_id' => $user->id,'status' => 'active',]);

            // Add random cart items to the cart
            $this->addRandomCartItems($cart);
        });
    }

    protected function addRandomCartItems(Cart $cart)
    {
        // Get all products from the database
        $products = Product::all();

        // Create random cart items for the cart
        $products->each(function ($product) use ($cart) {
            $quantity = rand(1, 5);

            // If quantity is greater than 1, calculate the total price
            $totalPrice = $quantity > 1 ? $quantity * $product->product_price : $product->product_price;

            CartItem::factory()->create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $totalPrice,
            ]);
        });
    }
}
