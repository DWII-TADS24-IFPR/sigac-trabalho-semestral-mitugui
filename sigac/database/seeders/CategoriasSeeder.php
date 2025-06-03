<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            'Curso online',
            'Participação em evento',
            'Saída de campo',
            'Apresentação assistida',
        ];

        foreach ([1, 2, 3] as $cursoId) {
            foreach ($categorias as $categoria) {
                Categoria::create([
                    'nome' => $categoria,
                    'maximo_horas' => 100,
                    'curso_id' => $cursoId,
                ]);
            }
        }
    }
}
