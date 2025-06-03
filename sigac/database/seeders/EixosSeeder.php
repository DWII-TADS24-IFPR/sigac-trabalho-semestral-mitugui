<?php

namespace Database\Seeders;

use App\Models\Eixo;
use Illuminate\Database\Seeder;

class EixosSeeder extends Seeder
{
    public function run(): void
    {
        $eixos = [
            ['nome' => 'Tecnologia'],
            ['nome' => 'Meio Ambiente'],
        ];

        foreach ($eixos as $eixo) {
            Eixo::create($eixo);
        }
    }
}
