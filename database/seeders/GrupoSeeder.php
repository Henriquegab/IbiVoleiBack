<?php

namespace Database\Seeders;

use App\Models\Grupo;
use App\Models\GrupoUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Grupo::create([
            'nome' => 'Ibi Volei',
            'imagem' => 'imagens/PM9ZCBh8QTjo4MQgOE3sQvT8NS0PQzS9fPgidfAQ.jpg',

        ]);
        GrupoUser::create([
            'user_id' => 1,
            'grupo_id' => 1,
            'admin' => 1,
            'status' => 1,
        ]);
    }
}
