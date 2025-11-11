<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Pastikan ini ada

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $menus = Menu::latest()->get(); 
        return view('admin.menu.index', ['menus' => $menus]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        

        return view('admin.menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'kategori' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string|max:500',
        ]);

        $gambar = $request->file('gambar');
        $namaGambar = time() . '.' . $gambar->extension();
        $gambar->move(public_path('Assets'), $namaGambar);

        Menu::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'gambar' => $namaGambar,
            'deskripsi' => $request->deskripsi,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Menu baru berhasil ditambahkan!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        return view('admin.menu.edit', ['menu' => $menu]);
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'kategori' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Boleh kosong
            'deskripsi' => 'nullable|string|max:500',
        ]);

        $data = $request->only(['nama', 'harga', 'kategori', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            if ($menu->gambar && file_exists(public_path('Assets/' . $menu->gambar))) {
                unlink(public_path('Assets/' . $menu->gambar));
            }
            $gambar = $request->file('gambar');
            $namaGambar = time() . '.' . $gambar->extension();
            $gambar->move(public_path('Assets'), $namaGambar);
            $data['gambar'] = $namaGambar;
        }

        $menu->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Menu berhasil diperbarui!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);

        if ($menu->gambar && file_exists(public_path('Assets/' . $menu->gambar))) {
            unlink(public_path('Assets/' . $menu->gambar));
        }

        $menu->delete();

        return redirect()->route('admin.menu.index')
                         ->with('success', 'Menu berhasil dihapus!');
    }
}