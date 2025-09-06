<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

  public function definition(): array
{
    return [
        'name_ar' => $this->faker->word() . ' ' . uniqid() . ' (AR)',
        'name_en' => $this->faker->word() . ' ' . uniqid() . ' (EN)',
        'icon'    => '',
    ];
}
}
