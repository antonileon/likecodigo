<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tipo_usuarios')->insert([
            [
            'nombre'                => 'SuperUsuario',
            'slug'                  =>  Str::slug('SuperUsuario', '-')
            ],
            [
            'nombre'                => 'Administrador',
            'slug'                  =>  Str::slug('Administrador', '-')
            ],
            [
            'nombre'                => 'Medico',
            'slug'                  =>  Str::slug('medico', '-')
            ],
            [
            'nombre'                => 'Paciente',
            'slug'                  =>  Str::slug('paciente', '-')
            ]
        ]);
    }
}
