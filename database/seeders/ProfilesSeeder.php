<?php

namespace Database\Seeders;

use App\Models\Profiles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profiles::factory()->create([
            'uuid' => fake()->uuid(),
            'name' => 'user',
        ]);

        Profiles::factory()->create([
            'uuid' => fake()->uuid(),
            'name' => 'admin',
        ]);
    }
}
