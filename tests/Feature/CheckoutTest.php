<?php

use App\Models\Menu;

test('checkout page displays cart items', function () {
    $menu1 = Menu::factory()->create(['nama' => 'Menu 1', 'harga' => 15000]);
    $menu2 = Menu::factory()->create(['nama' => 'Menu 2', 'harga' => 20000]);

    // Add items to cart
    $this->post('/cart/add', ['product_id' => $menu1->id]);
    $this->post('/cart/add', ['product_id' => $menu2->id]);

    $response = $this->get('/checkout');

    $response->assertStatus(200);
    $response->assertViewIs('checkout');
    $response->assertViewHas('cartItems');
    
    $cartItems = $response->viewData('cartItems');
    expect($cartItems)->toHaveCount(2);
});

test('cannot checkout with empty cart', function () {
    $response = $this->get('/checkout');

    $response->assertRedirect(route('cart.show'));
    $response->assertSessionHas('success');
});

test('checkout form validation requires name and whatsapp', function () {
    $menu = Menu::factory()->create();
    $this->post('/cart/add', ['product_id' => $menu->id]);

    // Try checkout without required fields
    $response = $this->post('/checkout/process', []);

    $response->assertSessionHasErrors(['nama', 'whatsapp']);
});

test('checkout generates correct whatsapp message format', function () {
    $menu1 = Menu::factory()->create(['nama' => 'Test Menu', 'harga' => 15000]);
    $menu2 = Menu::factory()->create(['nama' => 'Another Menu', 'harga' => 20000]);

    $this->post('/cart/add', ['product_id' => $menu1->id]);
    $this->post('/cart/add', ['product_id' => $menu2->id]);

    $response = $this->post('/checkout/process', [
        'nama' => 'John Doe',
        'whatsapp' => '081234567890',
    ]);

    // Check that the redirect URL contains WhatsApp link
    $redirectUrl = $response->getTargetUrl();
    expect($redirectUrl)->toContain('wa.me/089530428832');
    expect($redirectUrl)->toContain('text=');
    
    // Decode and check message content
    $parsedUrl = parse_url($redirectUrl);
    parse_str($parsedUrl['query'], $queryParams);
    $message = urldecode($queryParams['text']);
    
    expect($message)->toContain('John Doe');
    expect($message)->toContain('Kode Nota:');
    expect($message)->toContain('Test Menu');
    expect($message)->toContain('Another Menu');
    expect($message)->toContain('Total:');
});

test('checkout clears cart after processing', function () {
    $menu = Menu::factory()->create();
    $this->post('/cart/add', ['product_id' => $menu->id]);

    expect(session('cart'))->toHaveKey($menu->id);

    $this->post('/checkout/process', [
        'nama' => 'John Doe',
        'whatsapp' => '081234567890',
    ]);

    expect(session('cart'))->toBeNull();
});

test('checkout redirects to whatsapp url', function () {
    $menu = Menu::factory()->create();
    $this->post('/cart/add', ['product_id' => $menu->id]);

    $response = $this->post('/checkout/process', [
        'nama' => 'John Doe',
        'whatsapp' => '081234567890',
    ]);

    $response->assertRedirect();
    $redirectUrl = $response->getTargetUrl();
    expect($redirectUrl)->toStartWith('https://wa.me/');
});

