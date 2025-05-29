<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    // Listar todas as características
    public function index()
    {
        return response()->json(Feature::all());
    }

    // Criar nova característica
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|unique:features,nome',
        ]);

        $feature = Feature::create($validated);

        return response()->json($feature, 201);
    }

    // Atualizar característica
    public function update(Request $request, $id)
    {
        $feature = Feature::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|unique:features,nome,' . $id,
        ]);

        $feature->update($validated);

        return response()->json($feature);
    }

    // Deletar característica
    public function destroy($id)
    {
        $feature = Feature::findOrFail($id);
        $feature->delete();

        return response()->json(null, 204);
    }
}