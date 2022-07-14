<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'tipo_usuario_id'       => 1,
            'tipo_documento_id'     => 1,
            'nombre'                => 'Antoni',
            'apellido'              => 'Leon',
            'nombre_usuario'        => 'root',
            'slug'                  => Str::slug('root', '-'),
            'email'                 => 'admin@gmail.com',
            'password'              => bcrypt('1234'),
            'status'                => 'Activo'            
        ])->assignRole('SuperUsuario');

        User::factory(9)->create();
    }
}
