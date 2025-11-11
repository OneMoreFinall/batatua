<?php

use App\Models\Menu;

test('menu index returns json when requested', function () {
    Menu::factory()->count(3)->create();

    $response = $this->getJson('/menu');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        '*' => ['id', 'nama', 'harga', 'kategori', 'gambar', 'deskripsi'],
    ]);
    
    $menus = $response->json();
    expect($menus)->toHaveCount(3);
});

test('menu filtering by category parameter', function () {
    Menu::factory()->create(['kategori' => 'makanan-berat']);
    Menu::factory()->create(['kategori' => 'makanan-berat']);
    Menu::factory()->create(['kategori' => 'coffee']);
    Menu::factory()->create(['kategori' => 'non-coffe']);

    $response = $this->get('/menu?kategori=coffee');

    $response->assertStatus(200);
    $menus = $response->viewData('menus');
    expect($menus)->toHaveCount(1);
    expect($menus->first()->kategori)->toBe('coffee');
});

test('menu page view renders correctly', function () {
    Menu::factory()->count(5)->create();

    $response = $this->get('/menu');

    $response->assertStatus(200);
    $response->assertViewIs('menu');
    $response->assertViewHas('menus');
    
    $menus = $response->viewData('menus');
    expect($menus)->toHaveCount(5);
});

