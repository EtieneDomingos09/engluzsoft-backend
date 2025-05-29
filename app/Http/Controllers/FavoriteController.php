<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    // Listar imóveis favoritos de um usuário
    public function index($userId)
    {
        $favoritos = Favorite::with('property')
            ->where('user_id', $userId)
            ->get();

        return response()->json($favoritos);
    }

    // Adicionar um imóvel aos favoritos
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id',
        ]);

        // Evitar duplicação
        $favorito = Favorite::firstOrCreate($validated);

        return response()->json($favorito, 201);
    }

    // Remover favorito
    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id',
        ]);

        Favorite::where('user_id', $validated['user_id'])
            ->where('property_id', $validated['property_id'])
            ->delete();

        return response()->json(null, 204);
    }
}