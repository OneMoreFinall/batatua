<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use App\Models\AdminActivity;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    public function index()
    {
        $images = GalleryImage::latest()->get();
        return view('admin.gallery.index', ['images' => $images]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gambar = $request->file('gambar');
        $namaGambar = time() . '.' . $gambar->extension();
        $gambar->move(public_path('Assets'), $namaGambar);

        $image = GalleryImage::create([
            'title' => $request->input('title'),
            'image_path' => $namaGambar,
        ]);

        AdminActivity::create([
            'user_id' => Auth::id(),
            'action_type' => 'add',
            'model_type' => 'Galeri',
            'description' => 'Menambahkan galeri: ' . $request->input('title')
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil ditambahkan!',
            'image' => $image,
        ]);
    }

    public function update(Request $request, GalleryImage $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['title']);

        if ($request->hasFile('gambar')) {
            if ($gallery->image_path && file_exists(public_path('Assets/' . $gallery->image_path))) {
                unlink(public_path('Assets/' . $gallery->image_path));
            }
            $gambar = $request->file('gambar');
            $namaGambar = time() . '.' . $gambar->extension();
            $gambar->move(public_path('Assets'), $namaGambar);
            $data['image_path'] = $namaGambar;
        }

        $gallery->update($data);

        AdminActivity::create([
            'user_id' => Auth::id(),
            'action_type' => 'edit',
            'model_type' => 'Galeri',
            'description' => 'Memperbarui galeri: ' . $gallery->title
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil diperbarui!',
            'image' => $gallery->fresh(),
        ]);
    }

    public function destroy(GalleryImage $gallery)
    {
        if ($gallery->image_path && file_exists(public_path('Assets/' . $gallery->image_path))) {
            unlink(public_path('Assets/' . $gallery->image_path));
        }

        AdminActivity::create([
            'user_id' => Auth::id(),
            'action_type' => 'delete',
            'model_type' => 'Galeri',
            'description' => 'Menghapus galeri: ' . $gallery->title
        ]);

        $gallery->delete();

        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil dihapus!',
        ]);
    }
}