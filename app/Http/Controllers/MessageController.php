<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Listar todas as mensagens de um usuário (enviadas e recebidas)
    public function index($userId)
    {
        $mensagens = Message::with(['sender', 'receiver', 'property'])
            ->where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($mensagens);
    }

    // Enviar uma nova mensagem
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
            'property_id' => 'nullable|exists:properties,id',
            'conteudo' => 'required|string',
        ]);

        $mensagem = Message::create($validated);

        return response()->json($mensagem, 201);
    }

    // Visualizar uma mensagem específica
    public function show($id)
    {
        $mensagem = Message::with(['sender', 'receiver', 'property'])->findOrFail($id);

        // Marcar como lida ao visualizar
        if (!$mensagem->lido) {
            $mensagem->update(['lido' => true]);
        }

        return response()->json($mensagem);
    }

    // Deletar uma mensagem
    public function destroy($id)
    {
        $mensagem = Message::findOrFail($id);
        $mensagem->delete();

        return response()->json(null, 204);
    }
}