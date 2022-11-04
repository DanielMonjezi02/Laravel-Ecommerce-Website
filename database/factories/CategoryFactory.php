<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;


class CategoryFactory extends Factory
{
    public function definition()
    {
        return [
            'category' => fake()->word()
        ];
    }
}
