<?php

use App\Models\Menu;
use App\Models\GalleryImage;

test('home page displays correctly with featured menus and gallery', function () {
    // Create some menus and gallery images
    Menu::factory()->count(5)->create();
    GalleryImage::factory()->count(5)->create();

    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertViewIs('home');
    $response->assertViewHas('featuredMenus');
    $response->assertViewHas('galleryImages');
});

test('menu page displays all menus', function () {
    Menu::factory()->count(10)->create();

    $response = $this->get('/menu');

    $response->assertStatus(200);
    $response->assertViewIs('menu');
    $response->assertViewHas('menus');
    
    $menus = $response->viewData('menus');
    expect($menus)->toHaveCount(10);
});

test('menu filtering by category works', function () {
    Menu::factory()->create(['kategori' => 'makanan-berat']);
    Menu::factory()->create(['kategori' => 'makanan-berat']);
    Menu::factory()->create(['kategori' => 'coffee']);
    Menu::factory()->create(['kategori' => 'non-coffe']);

    $response = $this->get('/menu?kategori=makanan-berat');

    $response->assertStatus(200);
    $menus = $response->viewData('menus');
    expect($menus)->toHaveCount(2);
    expect($menus->pluck('kategori')->unique())->toContain('makanan-berat');
});

test('contact page is accessible', function () {
    $response = $this->get('/contact');

    $response->assertStatus(200);
    $response->assertViewIs('contact');
});

test('all public routes are accessible without authentication', function () {
    $this->assertGuest();

    $this->get('/')->assertStatus(200);
    $this->get('/menu')->assertStatus(200);
    $this->get('/contact')->assertStatus(200);
});

