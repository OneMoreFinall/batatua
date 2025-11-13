<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\GalleryImage;
use App\Models\AdminNote;
use App\Models\AdminActivity;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMenu = Menu::count();
        $totalGaleri = GalleryImage::count();
        $adminNotes = AdminNote::latest()->get();
        $activities = AdminActivity::latest()->take(4)->get();

        return view('admin.dashboard', [
            'totalMenu' => $totalMenu,
            'totalGaleri' => $totalGaleri,
            'adminNotes' => $adminNotes,
            'activities' => $activities,
        ]);
    }   
}