<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'jeki',
            'email' => 'admin@batatua.com',
            'is_admin' => 1,
        ]);

        $this->call([
            MenuSeeder::class,
            GalleryImageSeeder::class,
        ]);
    }
}