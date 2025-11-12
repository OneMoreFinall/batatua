<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\GalleryImage;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMenu = Menu::count();
        $totalGaleri = GalleryImage::count();
        
        return view('admin.dashboard', [
            'totalMenu' => $totalMenu,
            'totalGaleri' => $totalGaleri,
        ]);
    }   
}