<?php

namespace App\Http\Controllers;

use App\Models\PropertyPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyPhotoController extends Controller
{
    // Listar fotos de um imóvel
    public function index($propertyId)
    {
        $fotos = PropertyPhoto::where('property_id', $propertyId)->get();
        return response()->json($fotos);
    }

    // Adicionar nova foto ao imóvel
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'foto' => 'required|image|max:2048', // max 2MB
        ]);

        // Salvar a imagem no disco
        $path = $request->file('foto')->store('property_photos', 'public');

        $foto = PropertyPhoto::create([
            'property_id' => $validated['property_id'],
            'path' => $path,
        ]);

        return response()->json($foto, 201);
    }

    // Remover uma foto
    public function destroy($id)
    {
        $foto = PropertyPhoto::findOrFail($id);

        // Remover o arquivo do disco
        if (Storage::disk('public')->exists($foto->path)) {
            Storage::disk('public')->delete($foto->path);
        }

        $foto->delete();

        return response()->json(null, 204);
    }
}
