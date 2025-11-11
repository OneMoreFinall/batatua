<?php

use App\Models\User;
use App\Models\Menu;
use App\Models\GalleryImage;

test('admin middleware blocks non-admin users', function () {
    $user = User::factory()->create(['is_admin' => false]);

    $response = $this->actingAs($user)->get('/admin/dashboard');

    $response->assertRedirect(route('home'));
    $response->assertSessionHas('error', 'Anda tidak punya hak akses admin.');
});

test('admin routes require authentication', function () {
    $response = $this->get('/admin/dashboard');

    $response->assertRedirect(route('admin.login'));
});

test('regular users cannot access admin routes', function () {
    $user = User::factory()->create(['is_admin' => false]);

    // Test various admin routes
    $this->actingAs($user)->get('/admin/dashboard')->assertRedirect(route('home'));
    $this->actingAs($user)->get('/admin/menu')->assertRedirect(route('home'));
    $this->actingAs($user)->get('/admin/gallery')->assertRedirect(route('home'));
    
    $menu = Menu::factory()->create();
    $this->actingAs($user)->get("/admin/menu/{$menu->id}/edit")->assertRedirect(route('home'));
});

test('admin users can access all admin routes', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    Menu::factory()->create();
    GalleryImage::factory()->create();

    $this->actingAs($admin)->get('/admin/dashboard')->assertStatus(200);
    $this->actingAs($admin)->get('/admin/menu')->assertStatus(200);
    $this->actingAs($admin)->get('/admin/gallery')->assertStatus(200);
});

