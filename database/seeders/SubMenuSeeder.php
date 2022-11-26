<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubMenu;

class SubMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subMenu = [
            [
                'menu_id'     => 9,
                'nombre'      => 'Usuarios',
                'descripcion' => 'Usuarios',
                'ruta'        => 'users.index',
                'url'         => 'users',
                'orden'       => 1,
                'status'      => '1'
            ],
            [
                'menu_id'     => 9,
                'nombre'      => 'Roles',
                'descripcion' => 'Roles',
                'ruta'        => 'roles.index',
                'url'         => 'roles',
                'orden'       => 2,
                'status'      => '1'
            ],
            [
                'menu_id'     => 9,
                'nombre'      => 'Permisos',
                'descripcion' => 'Permisos',
                'ruta'        => 'permissions.index',
                'url'         => 'permissions',
                'orden'       => 3,
                'status'      => '1'
            ]
        ];
        foreach($subMenu as $key => $value) {
            SubMenu::create($value);
        }
    }
}
