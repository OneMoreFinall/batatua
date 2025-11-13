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
            'title' => 'Suasana Outdoor',
            'image_path' => 'placeholder_gallery_1.jpg'
        ]);

        GalleryImage::create([
            'title' => 'Interior Kedai',
            'image_path' => 'placeholder_gallery_2.jpg'
        ]);

        GalleryImage::create([
            'title' => 'Spot Foto #1',
            'image_path' => 'placeholder_gallery_3.jpg'
        ]);

        GalleryImage::create([
            'title' => 'Area Bar',
            'image_path' => 'placeholder_gallery_4.jpg'
        ]);

        GalleryImage::create([
            'title' => 'Tampak Depan',
            'image_path' => 'placeholder_gallery_5.jpg'
        ]);
    }
}