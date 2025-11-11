<?php

namespace App\Http\Controllers\Admin;
use App\Models\GalleryImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleryImages = GalleryImage::all();
        return view('admin.gallery.index', ['images' => $galleryImages]);
    }

        public function update(Request $request, string $id)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $galleryImage = GalleryImage::findOrFail($id);

        if ($galleryImage->image_path != 'placeholder.jpg' && file_exists(public_path('Assets/' . $galleryImage->image_path))) {
            unlink(public_path('Assets/' . $galleryImage->image_path));
        }

        $gambar = $request->file('gambar');
        $namaGambar = 'gallery_' . $id . '_' . time() . '.' . $gambar->extension();
        $gambar->move(public_path('Assets'), $namaGambar); 

        $galleryImage->update([
            'image_path' => $namaGambar,
        ]);

        return redirect()->route('admin.gallery.index')
                        ->with('success', $galleryImage->slot_name . ' berhasil diperbarui!');
    }
}
