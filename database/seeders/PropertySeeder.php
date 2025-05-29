<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\User;
use App\Models\Feature;

class PropertySeeder extends Seeder
{
    public function run()
    {
        $userIds = User::pluck('id')->toArray();
        $featureIds = Feature::pluck('id')->toArray();

        for ($i = 1; $i <= 20; $i++) {
            $property = Property::create([
                'user_id' => $userIds[array_rand($userIds)],
                'tipo_imovel' => ['casa', 'apartamento'][array_rand(['casa', 'apartamento'])],
                'tipo_transacao' => ['venda', 'aluguel'][array_rand(['venda', 'aluguel'])],
                'titulo' => "Imóvel $i",
                'descricao' => "Descrição do imóvel $i",
                'quartos' => rand(1, 5),
                'banheiros' => rand(1, 3),
                'area_util' => rand(50, 150),
                'area_total' => rand(60, 200),
                'endereco' => "Endereço do imóvel $i",
                'provincia' => "Província $i",
                'municipio' => "Município $i",
                'preco' => rand(80000, 500000),
                'telefone_contato' => '999999999',
                'latitude' => rand(4000, 5000),
                'longitude' => rand(6000, 9000),
            ]);

            // Associar algumas características aleatórias
            $property->features()->attach(array_rand(array_flip($featureIds), rand(1, 3)));
        }
    }
}
