<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNote;
use Illuminate\Http\Request;

class AdminNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('admin.dashboard');
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
            'content' => 'required|string|max:1000',
        ]);

        $note = AdminNote::create([
            'content' => $request->input('content'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Catatan berhasil ditambahkan!',
            'note' => $note, 
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(AdminNote $adminNote)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminNote $adminNote)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdminNote $note)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $note->update([
            'content' => $request->input('content'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Catatan berhasil diperbarui!',
            'note' => $note,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminNote $note)
    {
        $note->delete();

        return response()->json([
            'success' => true,
            'message' => 'Catatan berhasil dihapus!',
        ]);
    }
}