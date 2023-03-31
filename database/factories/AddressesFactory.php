<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Addresses>
 */
class AddressesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cep = DB::table('ceps')->inRandomOrder()->get()->first();

        return [
            'uuid' => fake('pt_BR')->uuid(),
            'name' => fake('pt_BR')->streetAddress(),

            'cep_uuid' => $cep->uuid,
        ];
    }
}
