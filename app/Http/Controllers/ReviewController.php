<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Listar todas as avaliações de um imóvel
    public function index($propertyId)
    {
        $reviews = Review::with('user')
            ->where('property_id', $propertyId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($reviews);
    }

    // Criar nova avaliação
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id',
            'nota' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string',
        ]);

        // Evita múltiplas avaliações do mesmo user para o mesmo imóvel
        $review = Review::updateOrCreate(
            [
                'user_id' => $validated['user_id'],
                'property_id' => $validated['property_id']
            ],
            [
                'nota' => $validated['nota'],
                'comentario' => $validated['comentario'] ?? null,
            ]
        );

        return response()->json($review, 201);
    }

    // Atualizar avaliação (caso não use updateOrCreate)
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $validated = $request->validate([
            'nota' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string',
        ]);

        $review->update($validated);

        return response()->json($review);
    }

    // Deletar avaliação
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return response()->json(null, 204);
    }
}