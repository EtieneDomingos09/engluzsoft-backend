<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    // Listar todos os imóveis com user, fotos e features
    public function index()
    {
        $properties = Property::with(['user', 'photos', 'features'])->get();
        return response()->json($properties);
    }

    // Cadastrar novo imóvel
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'tipo_imovel' => 'required|string',
            'tipo_transacao' => 'required|string',
            'titulo' => 'required|string',
            'descricao' => 'nullable|string',
            'quartos' => 'nullable|integer',
            'banheiros' => 'nullable|integer',
            'area_util' => 'nullable|numeric',
            'area_total' => 'nullable|numeric',
            'endereco' => 'required|string',
            'provincia' => 'required|string',
            'municipio' => 'required|string',
            'preco' => 'required|numeric',
            'telefone_contato' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $property = Property::create($validated);

        return response()->json($property, 201);
    }

    // Mostrar imóvel por ID
    public function show($id)
    {
        $property = Property::with(['user', 'photos', 'features'])->findOrFail($id);
        return response()->json($property);
    }

    // Atualizar imóvel
    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        $validated = $request->validate([
            'tipo_imovel' => 'sometimes|required|string',
            'tipo_transacao' => 'sometimes|required|string',
            'titulo' => 'sometimes|required|string',
            'descricao' => 'nullable|string',
            'quartos' => 'nullable|integer',
            'banheiros' => 'nullable|integer',
            'area_util' => 'nullable|numeric',
            'area_total' => 'nullable|numeric',
            'endereco' => 'sometimes|required|string',
            'provincia' => 'sometimes|required|string',
            'municipio' => 'sometimes|required|string',
            'preco' => 'sometimes|required|numeric',
            'telefone_contato' => 'sometimes|required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $property->update($validated);

        return response()->json($property);
    }

    // Deletar imóvel
    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();

        return response()->json(null, 204);
    }
}
