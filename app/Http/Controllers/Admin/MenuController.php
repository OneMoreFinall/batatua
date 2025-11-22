<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\AdminActivity;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        // Logika filter server-side
        $query = Menu::query();

        if ($request->has('kategori') && $request->kategori != 'all') {
            $query->where('kategori', $request->kategori);
        }

        if ($request->has('search') && $request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }
        
        $menus = $query->latest()->get();
        
        // Jika request datang dari AJAX (JavaScript), kirim JSON
        if ($request->wantsJson()) {
            return response()->json([
                'menus' => $menus
            ]);
        }
        
        // Jika request biasa (buka halaman pertama kali), kirim View
        return view('admin.menu.index', ['menus' => $menus]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'kategori' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string|max:500',
            'label' => 'nullable|string|in:hot,best_seller',
        ]);

        $gambar = $request->file('gambar');
        $namaGambar = time() . '.' . $gambar->extension();
        $gambar->move(public_path('Assets'), $namaGambar);

        $menu = Menu::create([
            'nama' => $request->input('nama'),
            'harga' => $request->input('harga'),
            'kategori' => $request->input('kategori'),
            'gambar' => $namaGambar,
            'deskripsi' => $request->input('deskripsi'),
            'label' => $request->input('label'),
        ]);

        AdminActivity::create([
            'user_id' => Auth::id(),
            'action_type' => 'add',
            'model_type' => 'Menu',
            'description' => 'Menambahkan menu: ' . $request->input('nama')
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Menu baru berhasil ditambahkan!',
            'menu' => $menu
        ]);
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'kategori' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string|max:500',
            'label' => 'nullable|string|in:hot,best_seller',
        ]);

        $data = $request->only(['nama', 'harga', 'kategori', 'deskripsi', 'label']);

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

        AdminActivity::create([
            'user_id' => Auth::id(),
            'action_type' => 'edit',
            'model_type' => 'Menu',
            'description' => 'Memperbarui menu: ' . $menu->nama
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Menu berhasil diperbarui!',
            'menu' => $menu->fresh()
        ]);
    }

    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);

        AdminActivity::create([
            'user_id' => Auth::id(),
            'action_type' => 'delete',
            'model_type' => 'Menu',
            'description' => 'Menghapus menu: ' . $menu->nama
        ]);

        if ($menu->gambar && file_exists(public_path('Assets/' . $menu->gambar))) {
            unlink(public_path('Assets/' . $menu->gambar));
        }

        $menu->delete();

        if (request()->wantsJson()) {
             return response()->json([
                'success' => true,
                'message' => 'Menu berhasil dihapus!'
            ]);
        }

        return redirect()->route('admin.menu.index')
                         ->with('success', 'Menu berhasil dihapus!');
    }
}