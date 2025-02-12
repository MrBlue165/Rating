<?php

namespace Database\Seeders;

use App\Models\OldUser;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // OldUser::factory(10)->create();

        OldUser::factory()->create([
            'name' => 'Test OldUser',
            'email' => 'test@example.com',
        ]);
    }
}
