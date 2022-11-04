<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Especialidade;

class EspecialidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Especialidade::create([
            'empresa_id'                => 1,
            'especialidad'              => 'General'
        ]);

        Especialidade::create([
            'empresa_id'                => 1,
            'especialidad'              => 'Ortodoncista'
        ]);

        Especialidade::create([
            'empresa_id'                => 1,
            'especialidad'              => 'Ni idea'
        ]);

        Especialidade::create([
            'empresa_id'                => 1,
            'especialidad'              => 'Prueba'
        ]);
    }
}
