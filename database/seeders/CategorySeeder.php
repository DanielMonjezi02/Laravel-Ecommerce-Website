<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class CategorySeeder extends Seeder
{
    public function run()
    {
       Category::factory(5)->has(Product::factory(7))->create(); // When the seeder creates 4 categories, it will also create 5 products for that category 
    }
}
    