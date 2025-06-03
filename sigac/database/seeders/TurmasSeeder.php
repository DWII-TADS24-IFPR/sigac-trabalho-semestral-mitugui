<?php

namespace Database\Seeders;

use App\Models\Turma;
use Illuminate\Database\Seeder;

class TurmasSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([1, 2, 3] as $cursoId) {
            Turma::create(['ano' => 2023, 'curso_id' => $cursoId]);
            Turma::create(['ano' => 2024, 'curso_id' => $cursoId]);
            Turma::create(['ano' => 2025, 'curso_id' => $cursoId]);
        }
    }
}
