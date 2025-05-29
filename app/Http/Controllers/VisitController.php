<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    // Listar visitas de um usuário (agendadas com ele)
    public function index($userId)
    {
        $visitas = Visit::with('property')
            ->where('user_id', $userId)
            ->orderBy('data_hora', 'asc')
            ->get();

        return response()->json($visitas);
    }

    // Agendar uma nova visita
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id',
            'data_hora' => 'required|date|after:now',
            'status' => 'in:pendente,confirmado,cancelado',
            'observacoes' => 'nullable|string',
        ]);

        $visita = Visit::create($validated);

        return response()->json($visita, 201);
    }

    // Atualizar visita (status ou observações)
    public function update(Request $request, $id)
    {
        $visita = Visit::findOrFail($id);

        $validated = $request->validate([
            'data_hora' => 'sometimes|date|after:now',
            'status' => 'sometimes|in:pendente,confirmado,cancelado',
            'observacoes' => 'nullable|string',
        ]);

        $visita->update($validated);

        return response()->json($visita);
    }

    // Cancelar visita
    public function destroy($id)
    {
        $visita = Visit::findOrFail($id);
        $visita->delete();

        return response()->json(null, 204);
    }
}