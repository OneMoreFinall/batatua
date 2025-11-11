<?php

use App\Models\User;
use App\Models\GalleryImage;
use Illuminate\Http\UploadedFile;

beforeEach(function () {
    $this->admin = User::factory()->create(['is_admin' => true]);
    $this->user = User::factory()->create(['is_admin' => false]);
});

test('gallery index displays all images', function () {
    GalleryImage::factory()->count(5)->create();

    $response = $this->actingAs($this->admin)->get('/admin/gallery');

    $response->assertStatus(200);
    $response->assertViewIs('admin.gallery.index');
    $response->assertViewHas('images');
    
    $images = $response->viewData('images');
    expect($images)->toHaveCount(5);
});

test('update gallery image with validation', function () {
    $galleryImage = GalleryImage::factory()->create();
    $oldImagePath = public_path('Assets/' . $galleryImage->image_path);
    
    // Create a fake old image file
    if (!file_exists(public_path('Assets'))) {
        mkdir(public_path('Assets'), 0755, true);
    }
    file_put_contents($oldImagePath, 'fake image content');

    $newImage = UploadedFile::fake()->image('new-gallery.jpg', 800, 600);

    $response = $this->actingAs($this->admin)->post("/admin/gallery/update/{$galleryImage->id}", [
        'gambar' => $newImage,
    ]);

    $response->assertRedirect(route('admin.gallery.index'));
    $response->assertSessionHas('success');
    
    $galleryImage->refresh();
    expect($galleryImage->image_path)->not->toBe('placeholder.jpg');
    expect($galleryImage->image_path)->toContain('gallery_' . $galleryImage->id);
    expect(file_exists(public_path('Assets/' . $galleryImage->image_path)))->toBeTrue();
});

test('image upload validation', function () {
    $galleryImage = GalleryImage::factory()->create();

    // Try to update without image
    $response = $this->actingAs($this->admin)->post("/admin/gallery/update/{$galleryImage->id}", []);

    $response->assertSessionHasErrors('gambar');
});

test('non-admin cannot access gallery management', function () {
    $response = $this->actingAs($this->user)->get('/admin/gallery');

    $response->assertRedirect(route('home'));
    $response->assertSessionHas('error');
});

