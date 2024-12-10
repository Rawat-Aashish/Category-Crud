<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category_id = Category::inRandomOrder()->first();
        return [
            'parent_category_id' => $category_id->id,
            'name' => fake()->randomElement([
                'Enchiladas',
                'Pozole',
                'Tamales',
                'Tacos',
                'Nachos',
                'Chilaquiles',
                'Pizzas',
                'Risotto',
                'Carbonara',
                'Tiramisu',
                'Biryani',
                'Samosa',
                'Naan',
                'Noodles',
                'Noodle soup',
                'White rice',
                'Fried rice',
                'Char siu',
                'Prawn pie',
                'Crispy calamari rings',
                'Roast chicken'
            ])
        ];
    }
}
