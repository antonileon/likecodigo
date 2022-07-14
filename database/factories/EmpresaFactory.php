<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Empresa;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empresa>
 */
class EmpresaFactory extends Factory
{

    protected $model = Empresa::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $nombre = $this->faker->unique()->userName;
        return [
            'nombre'                        =>  $nombre,
            'slug'                          =>  Str::slug($nombre, '-'),
            'numero_identificacion'         =>  $this->faker->unique()->safeEmail,
            'email'                         =>  $this->faker->unique()->safeEmail,
            'telefono'                      =>  $this->faker->phoneNumber,
        ];
    }
}
