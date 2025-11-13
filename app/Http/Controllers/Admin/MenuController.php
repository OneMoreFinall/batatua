<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\AdminActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Menu::query();

        if ($request->has('kategori') && $request->kategori != 'all') {
            $query->where('kategori', $request->kategori);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }
        
        $menus = $query->latest()->get();
        
        if ($request->wantsJson()) {
            return response()->json($menus);
        }
        
        return view('admin.menu.index', ['menus' => $menus]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

        $menu = Menu::create([
            'nama' => $request->input('nama'),
            'harga' => $request->input('harga'),
            'kategori' => $request->input('kategori'),
            'gambar' => $namaGambar,
            'deskripsi' => $request->input('deskripsi'),
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'kategori' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);

        if ($menu->gambar && file_exists(public_path('Assets/' . $menu->gambar))) {
            unlink(public_path('Assets/' . $menu->gambar));
        }

        AdminActivity::create([
            'user_id' => Auth::id(),
            'action_type' => 'delete',
            'model_type' => 'Menu',
            'description' => 'Menghapus menu: ' . $menu->nama
        ]);

        $menu->delete();

        return response()->json([
            'success' => true,
            'message' => 'Menu berhasil dihapus!',
        ]);
    }
}