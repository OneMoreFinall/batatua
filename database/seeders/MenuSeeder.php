<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::truncate();

        Menu::create([
            'nama' => 'Sego Ayam Teriyaki',
            'harga' => 22000,
            'kategori' => 'makanan-berat',
            'gambar' => 'placeholder_ayam_teriyaki.jpg',
            'deskripsi' => 'Nasi pulen dengan ayam saus teriyaki gurih dan salad segar.',
            'label' => 'best_seller'
        ]);

        Menu::create([
            'nama' => 'Mie Bangladesh',
            'harga' => 15000,
            'kategori' => 'makanan-berat',
            'gambar' => 'placeholder_mie_bangladesh.jpg',
            'deskripsi' => 'Mie goreng khas dengan bumbu rempah yang kaya rasa dan sedikit pedas.',
            'label' => 'hot'
        ]);

        Menu::create([
            'nama' => 'Kentang Goreng',
            'harga' => 15000,
            'kategori' => 'makanan-ringan',
            'gambar' => 'placeholder_kentang.jpg',
            'deskripsi' => 'Kentang goreng renyah disajikan dengan saus sambal dan mayones.',
            'label' => null
        ]);

        Menu::create([
            'nama' => 'Kopi Susu Gula Aren',
            'harga' => 18000,
            'kategori' => 'coffee',
            'gambar' => 'placeholder_kopi.jpg',
            'deskripsi' => 'Perpaduan espresso, susu segar, dan manisnya gula aren asli.',
            'label' => 'best_seller'
        ]);
        
        Menu::create([
            'nama' => 'Es Cokelat Jadoel',
            'harga' => 16000,
            'kategori' => 'non-coffe',
            'gambar' => 'placeholder_cokelat.jpg',
            'deskripsi' => 'Minuman cokelat klasik dengan rasa pekat dan creamy.',
            'label' => null
        ]);
    }
}