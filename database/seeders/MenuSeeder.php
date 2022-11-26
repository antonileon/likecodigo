<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = [
            [
                'nombre'      => 'Dashboard',
                'descripcion' => 'Dashboard',
                'ruta'        => 'home',
                'url'         => 'home',
                'icono'       => 'fa fa-user',
                'orden'       => 1,
                'status'      => '1'
            ],
            [
                'nombre'      => 'Empresas',
                'descripcion' => 'Empresas',
                'ruta'        => 'empresas.index',
                'url'         => 'empresas',
                'icono'       => 'fa fa-building',
                'orden'       => 2,
                'status'      => '1'
            ],
            [
                'nombre'      => 'Consultorios',
                'descripcion' => 'Consultorios',
                'ruta'        => 'consultorios.index',
                'url'         => 'consultorios',
                'icono'       => 'fa fa-hospital',
                'orden'       => 3,
                'status'      => '1'
            ],
            [
                'nombre'      => 'Médicos',
                'descripcion' => 'Médicos',
                'ruta'        => 'medicos.index',
                'url'         => 'medicos',
                'icono'       => 'fa fa-user-doctor',
                'orden'       => 4,
                'status'      => '1'
            ],
            [
                'nombre'      => 'Pacientes',
                'descripcion' => 'Pacientes',
                'ruta'        => 'pacientes.index',
                'url'         => 'pacientes',
                'icono'       => 'fa fa-user-tie',
                'orden'       => 5,
                'status'      => '1'
            ],
            [
                'nombre'      => 'Especialidades',
                'descripcion' => 'Especialidades',
                'ruta'        => 'especialidades.index',
                'url'         => 'especialidades',
                'icono'       => 'fa-solid fa-stethoscope',
                'orden'       => 6,
                'status'      => '1'
            ],
            [
                'nombre'      => 'Servicios',
                'descripcion' => 'Servicios',
                'ruta'        => 'servicios.index',
                'url'         => 'servicios',
                'icono'       => 'fa-solid fa-tooth',
                'orden'       => 7,
                'status'      => '1'
            ],
            [
                'nombre'      => 'Citas',
                'descripcion' => 'Citas',
                'ruta'        => 'citas.index',
                'url'         => 'citas',
                'icono'       => 'fa-solid fa-clock',
                'orden'       => 8,
                'status'      => '1'
            ],
            [
                'nombre'      => 'Panel de control',
                'descripcion' => 'Panel de control',
                'ruta'        => '',
                'url'         => '',
                'icono'       => 'fa fa-grip-vertical',
                'orden'       => 9,
                'status'      => '1'
            ]
        ];
        foreach($menu as $key => $value) {
            Menu::create($value);
        }
    }
}
