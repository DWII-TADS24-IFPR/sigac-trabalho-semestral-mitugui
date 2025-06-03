<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Aluno;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersAlunosSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('pt_BR');

        User::create([
            'name' => 'Administrador',
            'email' => 'admin@email.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        $turmas2024 = [
            3, // Informática
            6, // ADS
            9, // Gestão Ambiental
        ];

        foreach ($turmas2024 as $index => $turmaId) {
            $cursoId = $index + 1;

            for ($i = 0; $i < 20; $i++) {
                $name = $faker->firstName . ' ' . $faker->lastName;
                $emailBase = strtolower(str_replace(' ', '.', $name));
                $email = $emailBase . '@teste.com';

                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make('12345678'),
                    'role' => 'aluno',
                ]);

                Aluno::create([
                    'nome' => $name,
                    'cpf' => $faker->unique()->cpf(false),
                    'email' => $email,
                    'senha' => Hash::make('12345678'),
                    'curso_id' => $cursoId,
                    'turma_id' => $turmaId,
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}
