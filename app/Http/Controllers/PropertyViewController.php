<?php

namespace App\Http\Controllers;

use App\Models\PropertyView;
use Illuminate\Http\Request;

class PropertyViewController extends Controller
{
    // Listar visualizações de um imóvel
    public function index($propertyId)
    {
        $views = PropertyView::with('user')
            ->where('property_id', $propertyId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($views);
    }

    // Registrar nova visualização
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'user_id' => 'nullable|exists:users,id',
            'ip_address' => 'nullable|ip',
        ]);

        $view = PropertyView::create([
            'property_id' => $validated['property_id'],
            'user_id' => $validated['user_id'] ?? null,
            'ip_address' => $validated['ip_address'] ?? $request->ip(),
        ]);

        return response()->json($view, 201);
    }
}