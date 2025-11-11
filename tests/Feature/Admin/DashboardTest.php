<?php

use App\Models\User;

test('admin dashboard is accessible to admin users', function () {
    $admin = User::factory()->create([
        'is_admin' => true,
    ]);

    $response = $this->actingAs($admin)->get('/admin/dashboard');

    $response->assertStatus(200);
    $response->assertViewIs('admin.dashboard');
});

test('non-admin users cannot access dashboard', function () {
    $user = User::factory()->create([
        'is_admin' => false,
    ]);

    $response = $this->actingAs($user)->get('/admin/dashboard');

    $response->assertRedirect(route('home'));
    $response->assertSessionHas('error');
});

test('unauthenticated users redirected to admin login', function () {
    $response = $this->get('/admin/dashboard');

    $response->assertRedirect(route('admin.login'));
});

