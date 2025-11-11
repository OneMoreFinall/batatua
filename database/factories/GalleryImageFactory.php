<?php

namespace Database\Factories;

use App\Models\GalleryImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GalleryImage>
 */
class GalleryImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GalleryImage::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slot_name' => 'Slot ' . fake()->numberBetween(1, 10),
            'image_path' => 'gallery_' . fake()->numberBetween(1, 10) . '.jpg',
        ];
    }
}

