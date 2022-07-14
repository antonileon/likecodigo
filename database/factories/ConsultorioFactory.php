<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Consultorio;
use App\Models\Empresa;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consultorio>
 */
class ConsultorioFactory extends Factory
{

    protected $model = Consultorio::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $nombre = $this->faker->unique()->userName;
        return [
            'empresa_id'                    =>  Empresa::factory(),
            'nombre'                        =>  $nombre,
            'slug'                          =>  Str::slug($nombre, '-'),
            'telefono'                      =>  $this->faker->phoneNumber,
            'direccion'                     =>  $this->faker->text,
        ];
    }
}
