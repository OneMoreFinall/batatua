<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\GalleryImage;

class HomeController extends Controller
{
    public function index()
    {
        $galleryImages = GalleryImage::all()->take(5);

        $featuredMenus = Menu::inRandomOrder()->take(3)->get();

        return view('home', [
            'galleryImages' => $galleryImages,
            'featuredMenus' => $featuredMenus,
        ]);
    }
}
