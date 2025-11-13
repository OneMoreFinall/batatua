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

        $limit = 3;

        $labeledMenus = Menu::whereNotNull('label')
                            ->inRandomOrder()
                            ->take($limit)
                            ->get();

        $labeledCount = $labeledMenus->count();
        $featuredMenus = $labeledMenus;

        if ($labeledCount < $limit) {
            $needed = $limit - $labeledCount;
            
            $unlabeledMenus = Menu::whereNull('label')
                                ->whereNotIn('id', $labeledMenus->pluck('id'))
                                ->inRandomOrder()
                                ->take($needed)
                                ->get();
                                
            $featuredMenus = $labeledMenus->merge($unlabeledMenus);
        }

        return view('home', [
            'galleryImages' => $galleryImages,
            'featuredMenus' => $featuredMenus,
        ]);
    }
}