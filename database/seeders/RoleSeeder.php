<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name'=>'SuperUsuario']);
        $role2 = Role::create(['name'=>'Administrador']);
        $role3 = Role::create(['name'=>'Medico']);
        $role4 = Role::create(['name'=>'Paciente']);

        Permission::create([
            'name'              => 'empresas.index',
            'description'       => 'Ver listado de empresas'
        ])->assignRole($role1);
        Permission::create([
            'name'              => 'empresas.create',
            'description'       => 'Registrar empresa'
        ])->assignRole($role1);
        Permission::create([
            'name'              => 'empresas.show',
            'description'       => 'Ver empresa'
        ])->assignRole($role1);
        Permission::create([
            'name'              => 'empresas.edit',
            'description'       => 'Editar empresa'
        ])->assignRole($role1);
        Permission::create([
            'name'              => 'empresas.destroy',
            'description'       => 'Eliminar empresa'
        ])->assignRole($role1);
        // ESPECIALIDADES
        Permission::create([
            'name'              => 'especialidades.index',
            'description'       => 'Ver listado de especialidades'
        ])->assignRole($role1);
        Permission::create([
            'name'              => 'especialidades.create',
            'description'       => 'Registrar especialidad'
        ])->assignRole($role1);
        Permission::create([
            'name'              => 'especialidades.show',
            'description'       => 'Ver especialidad'
        ])->assignRole($role1);
        Permission::create([
            'name'              => 'especialidades.edit',
            'description'       => 'Editar especialidad'
        ])->assignRole($role1);
        Permission::create([
            'name'              => 'especialidades.destroy',
            'description'       => 'Eliminar especialidad'
        ])->assignRole($role1);
        // SERVICIOS
        Permission::create([
            'name'              => 'servicios.index',
            'description'       => 'Ver listado de servicios'
        ])->assignRole($role1);
        Permission::create([
            'name'              => 'servicios.create',
            'description'       => 'Registrar servicio'
        ])->assignRole($role1);
        Permission::create([
            'name'              => 'servicios.show',
            'description'       => 'Ver servicio'
        ])->assignRole($role1);
        Permission::create([
            'name'              => 'servicios.edit',
            'description'       => 'Editar servicio'
        ])->assignRole($role1);
        Permission::create([
            'name'              => 'servicios.destroy',
            'description'       => 'Eliminar servicio'
        ])->assignRole($role1);
    }
}
