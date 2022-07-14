<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tipo_documentos')->insert([
            [
            'nombre'                => 'V',
            'slug'                  =>  Str::slug('V', '-')
            ],
            [
            'nombre'                => 'E',
            'slug'                  =>  Str::slug('E', '-')
            ],
            [
            'nombre'                => 'DNI',
            'slug'                  =>  Str::slug('DNI', '-')
            ]
        ]);
    }
}
