<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Empresa;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nombre_usuario = $this->faker->unique()->userName;
        return [
            'empresa_id'            => 1,
            'nombre'                => $this->faker->name,
            'apellido'              => $this->faker->name,
            'email'                 => $this->faker->unique()->safeEmail,
            'nombre_usuario'        => $nombre_usuario,
            'slug'                  =>  Str::slug($nombre_usuario, '-'),
            'email_verified_at'     => now(),
            'password'              => bcrypt('1234'), // password
            'tipo_usuario_id'       => 2,
            'status'                => 'Activo',
            'remember_token'        => Str::random(10),
        ];
    }
}
