<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory(5)->create()->each(function ($category) {
            $products = Product::factory(10)->create();
            $category->products()->attach($products);
            $products->each(function ($product) {
                $numberOfImages = rand(1, 3);
                $product->images()->saveMany(ProductImage::factory($numberOfImages)->make());
            });
        });
    }
}
