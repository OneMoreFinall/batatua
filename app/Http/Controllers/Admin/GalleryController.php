<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;

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

        $gallery->delete();

        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil dihapus!',
        ]);
    }
}