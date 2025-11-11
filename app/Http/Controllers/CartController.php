<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class CartController extends Controller
{
    public function add(Request $request)
{
    
    $request->validate([
        'product_id' => 'required|exists:menus,id',
    ]);

   
    $product = Menu::find($request->product_id);

   
    $cart = session()->get('cart', []);

   
    if(isset($cart[$product->id])) 
    {
        
        $cart[$product->id]['quantity']++;
    } 

    else {

        $cart[$product->id] = [
            "nama" => $product->nama,
            "quantity" => 1,
            "harga" => $product->harga,
            "gambar" => $product->gambar
        ];
    }

    
    session()->put('cart', $cart);

   
    return redirect()->route('menu')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
}

public function show()
{
    
    
    $cart = session()->get('cart', []);


    return view('cart', ['cartItems' => $cart]);
}

public function remove(Request $request)
{
    // 1. Validasi untuk memastikan product_id ada
    $request->validate([
        'product_id' => 'required|exists:menus,id'
    ]);

    // 2. Ambil keranjang dari session
    $cart = session()->get('cart');

    // 3. Cek apakah produk yang mau dihapus ada di keranjang
    if(isset($cart[$request->product_id])) {

        // 4. Hapus item tersebut dari array keranjang
        unset($cart[$request->product_id]);

        // 5. Simpan kembali keranjang yang sudah diupdate ke session
        session()->put('cart', $cart);
    }

    // 6. Kembalikan ke halaman keranjang dengan pesan sukses
    return redirect()->route('cart.show')->with('success', 'Produk berhasil dihapus dari keranjang.');
}

public function showCheckout()
{
    $cart = session()->get('cart', []);

    // Jangan biarkan orang checkout kalau keranjang kosong
    if (count($cart) == 0) {
        // Kita bisa tambahkan pesan 'error' juga
        return redirect()->route('cart.show')->with('success', 'Keranjang Anda kosong, tidak bisa checkout.');
    }

    // Kirim data ke view baru bernama 'checkout'
    return view('checkout', ['cartItems' => $cart]);
}

public function processCheckout(Request $request)
{
    $request->validate
    ([
        'nama' => 'required|string|max:255',
        'whatsapp' => 'required|string|max:20',
    ]);

        $namaPemesan = $request->nama;
        $nomorWA = $request->whatsapp;
        $cart = session()->get('cart', []);

        $kodeNota = 'NT' . time();
        $total = 0;
        $message = "Permisi halo, saya $namaPemesan\n"; 
        $message .= "Kode Nota: $kodeNota\n\n";
        $message .= "Pesanan:\n";

        foreach ($cart as $id => $item) 
        {
            $subtotal = $item['harga'] * $item['quantity'];
            $total += $subtotal;
            $subtotalFormatted = number_format($subtotal, 0, ',', '.');
            $message .= "{$item['nama']} x{$item['quantity']} - Rp{$subtotalFormatted}\n";
        }

        $totalFormatted = number_format($total, 0, ',', '.');
        $message .= "\nTotal: Rp{$totalFormatted}";

        // wa admin
        $nomorTujuan = '089530428832'; 
        $messageEncoded = urlencode($message); // Encode pesan agar aman
        $waUrl = "https://wa.me/{$nomorTujuan}?text={$messageEncoded}";

        // hapus keranjang
        session()->forget('cart');

        // 6. redirect user ke wa
        return redirect()->away($waUrl);
    }
}

