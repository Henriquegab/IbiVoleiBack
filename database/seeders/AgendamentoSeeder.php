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
            'data' => '2023-07-21 18:00:00',
            'fim' => '2023-07-21 20:00:00',
            'ativo' => 1
        ]);
        Agendamento::create([
            'nome' => 'henrique',
            'data' => '2023-07-22 18:00:00',
            'fim' => '2023-07-22 20:00:00',
            'ativo' => 1
        ]);
        Agendamento::create([
            'nome' => 'henrique',
            'data' => '2023-07-23 18:00:00',
            'fim' => '2023-07-23 20:00:00',
            'ativo' => 1
        ]);
        Agendamento::create([
            'nome' => 'henrique',
            'data' => '2023-07-24 18:00:00',
            'fim' => '2023-07-24 20:00:00',
            'ativo' => 1
        ]);
        Agendamento::create([
            'nome' => 'henrique',
            'data' => '2023-07-25 18:00:00',
            'fim' => '2023-07-25 20:00:00',
            'ativo' => 1
        ]);
        Agendamento::create([
            'nome' => 'henrique',
            'data' => '2023-07-26 18:00:00',
            'fim' => '2023-07-26 20:00:00',
            'ativo' => 1
        ]);
        Agendamento::create([
            'nome' => 'henrique',
            'data' => '2023-07-27 18:00:00',
            'fim' => '2023-07-27 20:00:00',
            'ativo' => 1
        ]);
    }
}
