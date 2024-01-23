<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Category::factory(5)->create()->each(function ($category) {
            // Product::factory(10)->create(['category_id' => $category->id]);
            //  Category::factory(5)->create()->each(function ($category) {
            //     $products = Product::factory(10)->create();
            //     $category->products()->attach($products);
            //     $products->each(function ($product) {
            //         $numberOfImages = rand(1, 3);
            //         $product->images()->saveMany(ProductImage::factory($numberOfImages)->make());
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    // });
// });

            $this->call([
                UserSeeder::class,
                ProductSeeder::class,
                CategoryProductSeeder::class,
            ]);
}
}


