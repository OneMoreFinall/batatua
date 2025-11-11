<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Menu::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $kategori = ['makanan-berat', 'makanan-ringan', 'coffee', 'non-coffe'];
        
        return [
            'nama' => fake()->words(2, true),
            'harga' => fake()->numberBetween(5000, 50000),
            'kategori' => fake()->randomElement($kategori),
            'gambar' => fake()->word() . '.jpg',
            'deskripsi' => fake()->sentence(),
        ];
    }
}

