<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\GalleryImage;
use App\Models\AdminActivity;
use App\Models\AdminNote;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMenu = Menu::count();
        $totalGaleri = GalleryImage::count();
        $adminNotes = AdminNote::latest()->get(); 
        
        $activities = AdminActivity::latest()->take(4)->get(); 

        $activityData = AdminActivity::where('created_at', '>=', now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get([
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count')
            ])
            ->pluck('count', 'date');

        $activityLabels = [];
        $activityCounts = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $activityLabels[] = now()->subDays($i)->format('D');
            $activityCounts[] = $activityData->get($date, 0);
        }
        
        return view('admin.dashboard', [
            'totalMenu' => $totalMenu,
            'totalGaleri' => $totalGaleri,
            'adminNotes' => $adminNotes,
            'activities' => $activities,
            'activityLabels' => $activityLabels,
            'activityData' => $activityCounts,
        ]);
    }   
}