<?php

use App\Models\Menu;

test('add item to cart', function () {
    $menu = Menu::factory()->create();

    $response = $this->post('/cart/add', [
        'product_id' => $menu->id,
    ]);

    $response->assertRedirect(route('menu'));
    $response->assertSessionHas('success');
    
    $cart = session('cart');
    expect($cart)->toHaveKey($menu->id);
    expect($cart[$menu->id])->toMatchArray([
        'nama' => $menu->nama,
        'quantity' => 1,
        'harga' => $menu->harga,
        'gambar' => $menu->gambar,
    ]);
});

test('add same item multiple times increments quantity', function () {
    $menu = Menu::factory()->create();

    // Add first time
    $this->post('/cart/add', ['product_id' => $menu->id]);
    
    // Add second time
    $response = $this->post('/cart/add', ['product_id' => $menu->id]);

    $response->assertRedirect(route('menu'));
    
    $cart = session('cart');
    expect($cart[$menu->id]['quantity'])->toBe(2);
});

test('view cart with items', function () {
    $menu1 = Menu::factory()->create();
    $menu2 = Menu::factory()->create();

    // Add items to cart
    $this->post('/cart/add', ['product_id' => $menu1->id]);
    $this->post('/cart/add', ['product_id' => $menu2->id]);

    $response = $this->get('/cart');

    $response->assertStatus(200);
    $response->assertViewIs('cart');
    $response->assertViewHas('cartItems');
    
    $cartItems = $response->viewData('cartItems');
    expect($cartItems)->toHaveCount(2);
    expect($cartItems)->toHaveKey($menu1->id);
    expect($cartItems)->toHaveKey($menu2->id);
});

test('remove item from cart', function () {
    $menu = Menu::factory()->create();

    // Add item to cart
    $this->post('/cart/add', ['product_id' => $menu->id]);
    
    // Verify item is in cart
    expect(session('cart'))->toHaveKey($menu->id);

    // Remove item
    $response = $this->post('/cart/remove', ['product_id' => $menu->id]);

    $response->assertRedirect(route('cart.show'));
    $response->assertSessionHas('success');
    
    $cart = session('cart');
    expect($cart)->not->toHaveKey($menu->id);
});

test('cart persists in session', function () {
    $menu = Menu::factory()->create();

    // Add item to cart
    $this->post('/cart/add', ['product_id' => $menu->id]);
    
    // Make another request and verify cart still exists
    $response = $this->get('/cart');
    
    $cartItems = $response->viewData('cartItems');
    expect($cartItems)->toHaveKey($menu->id);
});

test('empty cart handling', function () {
    $response = $this->get('/cart');

    $response->assertStatus(200);
    $response->assertViewIs('cart');
    
    $cartItems = $response->viewData('cartItems');
    expect($cartItems)->toBeEmpty();
});

