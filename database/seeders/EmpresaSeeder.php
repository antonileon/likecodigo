<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Empresa;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::create([
            'nombre'                    => 'LikeCodigo',
            'slug'                      => 'likecodigo' ,
            'numero_identificacion'     => '12345678',
            'email'                     => 'admin@gmail.com',
            'telefono'                  => '975467244'
        ]);
    }
}
