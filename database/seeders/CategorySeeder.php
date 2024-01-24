<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory(5)->create()->each(function ($category) {
            Product::factory(10)->create(['category_id' => $category->id]);
             Category::factory(5)->create()->each(function ($category) {
                $products = Product::factory(10)->create();
                $category->products()->attach($products);
                $products->each(function ($product) {
                    $numberOfImages = rand(1, 3);
                    $product->images()->saveMany(ProductImage::factory($numberOfImages)->make());

                });
                });
            });
        }
    }
