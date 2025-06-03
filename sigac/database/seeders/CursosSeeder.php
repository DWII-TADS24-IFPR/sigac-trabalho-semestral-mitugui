<?php

namespace Database\Seeders;

use App\Models\Curso;
use Illuminate\Database\Seeder;

class CursosSeeder extends Seeder
{
    public function run(): void
    {
        $cursos = [
            ['nome' => 'Informática', 'sigla' => 'INFO', 'total_horas' => 2000, 'nivel_id' => 1, 'eixo_id' => 1],
            ['nome' => 'Análise e Desenvolvimento de Sistemas', 'sigla' => 'ADS', 'total_horas' => 2800, 'nivel_id' => 2, 'eixo_id' => 1],
            ['nome' => 'Gestão Ambiental', 'sigla' => 'GA', 'total_horas' => 2600, 'nivel_id' => 2, 'eixo_id' => 2],
        ];

        foreach ($cursos as $curso) {
            Curso::create($curso);
        }
    }
}
