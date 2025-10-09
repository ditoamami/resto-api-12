<?php

namespace App\Http\Controllers;

use App\Models\BookTable;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        // Ambil semua meja beserta order aktif dan item-itemnya
        return BookTable::with(['currentOrder.items.menu'])->get();
    }

    public function updateStatus(Request $request, $id)
    {
        $table = BookTable::findOrFail($id);
        $table->update(['table_status' => $request->status]);

        return response()->json([
            'message' => 'Status meja diperbarui.',
            'table' => $table
        ]);
    }
}
