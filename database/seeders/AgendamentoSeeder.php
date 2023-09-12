<?php

namespace Database\Seeders;

use App\Models\Agendamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgendamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Agendamento::create([
            'nome' => 'henrique',
            'data' => now(),
            'fim' => now()->addHour(),
            'ativo' => 1,
            'grupo_id' => 1
        ]);

    }
}
