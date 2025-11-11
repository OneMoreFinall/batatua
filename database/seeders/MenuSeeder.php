<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama (jika ada) biar tidak duplikat
        DB::table('menus')->truncate();

        // Masukkan data baru
        DB::table('menus')->insert([
            [
                'nama' => 'Mie Bangladesh',
                'harga' => 15000,
                'kategori' => 'makanan-berat',
                'gambar' => 'mie bang.jpg',
            ],
            [
                'nama' => 'Sosis Crispy',
                'harga' => 16000,
                'kategori' => 'makanan-ringan',
                'gambar' => 'sosis.jpg',
            ],
            [
                'nama' => 'Sego Ayam Teriyaki',
                'harga' => 22000,
                'kategori' => 'makanan-berat',
                'gambar' => 'ayaam teriyaki.jpg',
            ],
            [
                'nama' => 'Kentang Goreng',
                'harga' => 15000,
                'kategori' => 'makanan-ringan',
                'gambar' => 'kentang.jpg',
            ],
            [
                'nama' => 'Teh O',
                'harga' => 8000,
                'kategori' => 'non-coffe',
                'gambar' => 'Esteh.jpg',
            ],
            [
                'nama' => 'Indomie Goreng Telor',
                'harga' => 15000,
                'kategori' => 'makanan-berat',
                'gambar' => 'menu mie.jpg',
            ],
            [
                'nama' => 'Teh Tarik',
                'harga' => 15000,
                'kategori' => 'non-coffe',
                'gambar' => 'teh tarik.jpg',
            ],
            [
                'nama' => 'Es Cokelat jadoel',
                'harga' => 16000,
                'kategori' => 'non-coffe',
                'gambar' => 'Cokelat.jpg',
            ],
            [
                'nama' => 'ice Americano',
                'harga' => 9000,
                'kategori' => 'coffee',
                'gambar' => 'america.jpg',
            ],
            [
                'nama' => 'Fish and Chips',
                'harga' => 25000,
                'kategori' => 'makanan-ringan',
                'gambar' => 'fish and chips.jpg',
            ],
            [
                'nama' => 'Blue Dragon',
                'harga' => 17000,
                'kategori' => 'non-coffe',
                'gambar' => 'blue dragon.jpg',
            ],
            [
                'nama' => 'Roti Bakar',
                'harga' => 8000,
                'kategori' => 'makanan-ringan',
                'gambar' => 'roti-bakar.jpg',
            ],
        ]);
    }
}