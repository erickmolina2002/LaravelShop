<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Models\Client;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'seller_id' => Seller::factory(),
            'sold_at' => fake()->dateTimeBetween('-8 year', 'now'),
            'total_amount' => fake()->numberBetween(10000,500000),
            'status' => fake()->randomElement(Status::cases()),
        ];
    }
}
