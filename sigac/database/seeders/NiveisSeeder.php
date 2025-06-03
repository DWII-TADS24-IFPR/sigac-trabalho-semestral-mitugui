<?php

namespace Database\Seeders;

use App\Models\Nivel;
use Illuminate\Database\Seeder;

class NiveisSeeder extends Seeder
{
    public function run(): void
    {
        $niveis = [
            ['nome' => 'Médio-Técnico'],
            ['nome' => 'Superior'],
        ];

        foreach ($niveis as $nivel) {
            Nivel::create($nivel);
        }
    }
}
