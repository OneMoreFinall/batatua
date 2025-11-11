<?php

use App\Models\User;

test('admin login page is accessible', function () {
    $response = $this->get('/admin/login');

    $response->assertStatus(200);
    $response->assertViewIs('admin.login');
});

test('admin can login with valid credentials', function () {
    $admin = User::factory()->create([
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
        'is_admin' => true,
    ]);

    $response = $this->post('/admin/login', [
        'email' => 'admin@example.com',
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('admin.dashboard'));
});

test('non-admin user cannot login via admin route', function () {
    $user = User::factory()->create([
        'email' => 'user@example.com',
        'password' => bcrypt('password'),
        'is_admin' => false,
    ]);

    $response = $this->post('/admin/login', [
        'email' => 'user@example.com',
        'password' => 'password',
    ]);

    $this->assertGuest();
    $response->assertSessionHasErrors('email');
    $response->assertRedirect();
});

test('admin login redirects to admin dashboard', function () {
    $admin = User::factory()->create([
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
        'is_admin' => true,
    ]);

    $response = $this->post('/admin/login', [
        'email' => 'admin@example.com',
        'password' => 'password',
    ]);

    $response->assertRedirect(route('admin.dashboard'));
});

test('already logged-in admin redirected from login page', function () {
    $admin = User::factory()->create([
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
        'is_admin' => true,
    ]);

    $response = $this->actingAs($admin)->get('/admin/login');

    $response->assertRedirect(route('admin.dashboard'));
});

test('invalid credentials show error', function () {
    $admin = User::factory()->create([
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
        'is_admin' => true,
    ]);

    $response = $this->post('/admin/login', [
        'email' => 'admin@example.com',
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
    $response->assertSessionHasErrors('email');
    $response->assertRedirect();
});

