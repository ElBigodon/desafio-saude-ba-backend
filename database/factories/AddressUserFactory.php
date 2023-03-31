<?php

namespace Database\Factories;

use App\Models\Addresses;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AddressUser>
 */
class AddressUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomAddress = Addresses::inRandomOrder()->get()->first();

        $randomUser = User::inRandomOrder()->get()->first();

        return [
            'uuid' => fake()->uuid(),

            'address_uuid' => $randomAddress->uuid,
            'user_uuid' =>  $randomUser->uuid,
        ];
    }
}
