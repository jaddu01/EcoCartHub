<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Product::factory(5)->create();
        //User::factory(1000)->create()->each(function($user){
            //$user->addresses()->saveMany(\App\Models\UserAddress::factory(rand(1,3))->make());
            //Category::factory(5)->create()->each(function ($categories) {
              //  $categories->products()->saveMany(Product::factory(10)->make());
             Category::factory(5)->create()->each(function ($category) {
                Product::factory(10)->create(['category_id' => $category->id]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    });

}
}
