<?php

namespace Database\Factories;

use App\Models\Good;
use App\Models\UnitOfGood;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GoodFactory extends Factory
{
    protected $model = Good::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $unitOfGoods = UnitOfGood::pluck('id')->toArray();
        return [
            'code' => fake()->unique()->postcode(),
            'name' => fake()->unique()->streetName(),
            'unit_of_good_id' => fake()->randomElement($unitOfGoods)
        ];
    }
}
