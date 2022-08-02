<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(TipoUsuarioSeeder::class);
        $this->call(TipoDocumentoSeeder::class);
        $this->call(EmpresaSeeder::class);
        $this->call(UsersTableSeeder::class);
        \App\Models\Consultorio::factory(5)->create();
        //\App\Models\Empresa::factory(5)->create();
    }
}
