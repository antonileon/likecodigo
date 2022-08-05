<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Models\Paciente;
use App\Models\Medico;

class Persona extends Model
{
    use HasFactory;

    protected $table = "personas";

    protected $fillable = [
        'tipo_documento_id',
        'numero_identificacion',
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'telefono',
        'genero',
        'direccion'
    ];

    public function medico()
    {
        return $this->hasOne(Medico::class);
    }

    public function paciente()
    {
        return $this->hasOne(Paciente::class);
    }

    public function tipo_documento()
    {
        return $this->belongsTo(TipoDocumento::class,'tipo_documento_id')->withDefault();
    }
}
