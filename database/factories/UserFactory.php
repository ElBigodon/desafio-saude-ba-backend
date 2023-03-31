<?php

namespace Database\Factories;

use App\Models\Profiles;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = fake('pt_BR');

        $profiles = DB::table('profiles')->inRandomOrder()->get()->first();

        return [
            'uuid' => $faker->uuid(),
            'name' => $faker->firstName() . ' ' . $faker->lastName(),
            'email' => $faker->email(),
            'cpf' => $faker->cpf(false),

            'profile_uuid' => $profiles->uuid,

            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime(),
        ];
    }
}
