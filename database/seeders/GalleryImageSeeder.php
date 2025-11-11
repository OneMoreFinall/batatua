<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GalleryImage;

class GalleryImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GalleryImage::truncate();

        GalleryImage::create([
            'slot_name' => 'Slot 1',
            'image_path' => 'placeholder.jpg',
        ]);
        GalleryImage::create([
            'slot_name' => 'Slot 2',
            'image_path' => 'placeholder.jpg',
        ]);
        GalleryImage::create([
            'slot_name' => 'Slot 3',
            'image_path' => 'placeholder.jpg',
        ]);
        GalleryImage::create([
            'slot_name' => 'Slot 4',
            'image_path' => 'placeholder.jpg',
        ]);
        GalleryImage::create([
            'slot_name' => 'Slot 5',
            'image_path' => 'placeholder.jpg',
        ]);
    }
}
