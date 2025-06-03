<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            NiveisSeeder::class,
            EixosSeeder::class,
            CursosSeeder::class,
            TurmasSeeder::class,
            UsersAlunosSeeder::class,
            CategoriasSeeder::class,
        ]);
    }
}
