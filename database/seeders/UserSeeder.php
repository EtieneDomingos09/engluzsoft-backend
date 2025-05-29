<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Garante que o usuário fixo não será duplicado
        User::firstOrCreate(
            ['email' => 'teste@email.com'],
            [
                'name' => 'Usuário Teste',
                'telefone_contato' => '123456789',
                'password' => Hash::make('12345678'),
                'tipo' => 'proprietario',
            ]
        );

        // Cria 5 usuários aleatórios (somente se a factory existir)
        if (method_exists(User::class, 'factory')) {
            User::factory()->count(5)->create();
        }
    }
}
