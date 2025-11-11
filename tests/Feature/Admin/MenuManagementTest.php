<?php

use App\Models\User;
use App\Models\Menu;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->admin = User::factory()->create(['is_admin' => true]);
    $this->user = User::factory()->create(['is_admin' => false]);
});

test('list all menus in admin panel', function () {
    Menu::factory()->count(5)->create();

    $response = $this->actingAs($this->admin)->get('/admin/menu');

    $response->assertStatus(200);
    $response->assertViewIs('admin.menu.index');
    $response->assertViewHas('menus');
    
    $menus = $response->viewData('menus');
    expect($menus)->toHaveCount(5);
});

test('create new menu with image upload', function () {
    Storage::fake('public');
    
    $image = UploadedFile::fake()->image('menu.jpg', 800, 600);

    $response = $this->actingAs($this->admin)->post('/admin/menu', [
        'nama' => 'Test Menu',
        'harga' => 15000,
        'kategori' => 'makanan-berat',
        'gambar' => $image,
        'deskripsi' => 'Test description',
    ]);

    $response->assertStatus(200);
    $response->assertJson([
        'success' => true,
        'message' => 'Menu baru berhasil ditambahkan!',
    ]);

    $this->assertDatabaseHas('menus', [
        'nama' => 'Test Menu',
        'harga' => 15000,
        'kategori' => 'makanan-berat',
        'deskripsi' => 'Test description',
    ]);

    $menu = Menu::where('nama', 'Test Menu')->first();
    expect($menu->gambar)->not->toBeNull();
    expect(file_exists(public_path('Assets/' . $menu->gambar)))->toBeTrue();
});

test('create menu validation requires all fields', function () {
    $response = $this->actingAs($this->admin)->post('/admin/menu', []);

    $response->assertSessionHasErrors(['nama', 'harga', 'kategori', 'gambar']);
});

test('update existing menu', function () {
    $menu = Menu::factory()->create([
        'nama' => 'Old Name',
        'harga' => 10000,
    ]);

    $response = $this->actingAs($this->admin)->patch("/admin/menu/{$menu->id}", [
        'nama' => 'New Name',
        'harga' => 20000,
        'kategori' => $menu->kategori,
        'deskripsi' => 'Updated description',
    ]);

    $response->assertStatus(200);
    $response->assertJson([
        'success' => true,
        'message' => 'Menu berhasil diperbarui!',
    ]);

    $this->assertDatabaseHas('menus', [
        'id' => $menu->id,
        'nama' => 'New Name',
        'harga' => 20000,
        'deskripsi' => 'Updated description',
    ]);
});

test('update menu with new image', function () {
    $menu = Menu::factory()->create();
    $oldImagePath = public_path('Assets/' . $menu->gambar);
    
    // Create a fake old image file
    if (!file_exists(public_path('Assets'))) {
        mkdir(public_path('Assets'), 0755, true);
    }
    file_put_contents($oldImagePath, 'fake image content');

    $newImage = UploadedFile::fake()->image('new-menu.jpg', 800, 600);

    $response = $this->actingAs($this->admin)->patch("/admin/menu/{$menu->id}", [
        'nama' => $menu->nama,
        'harga' => $menu->harga,
        'kategori' => $menu->kategori,
        'gambar' => $newImage,
    ]);

    $response->assertStatus(200);
    
    $menu->refresh();
    expect($menu->gambar)->not->toBe($oldImagePath);
    expect(file_exists(public_path('Assets/' . $menu->gambar)))->toBeTrue();
});

test('delete menu removes image file', function () {
    $menu = Menu::factory()->create();
    $imagePath = public_path('Assets/' . $menu->gambar);
    
    // Create a fake image file
    if (!file_exists(public_path('Assets'))) {
        mkdir(public_path('Assets'), 0755, true);
    }
    file_put_contents($imagePath, 'fake image content');
    expect(file_exists($imagePath))->toBeTrue();

    $response = $this->actingAs($this->admin)->delete("/admin/menu/{$menu->id}");

    $response->assertRedirect(route('admin.menu.index'));
    $response->assertSessionHas('success');
    
    $this->assertDatabaseMissing('menus', ['id' => $menu->id]);
    expect(file_exists($imagePath))->toBeFalse();
});

test('non-admin cannot access menu management', function () {
    $response = $this->actingAs($this->user)->get('/admin/menu');

    $response->assertRedirect(route('home'));
    $response->assertSessionHas('error');
});

