<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Servicio;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Cita extends Model
{
    use HasFactory, Notifiable;
    use HasRoles, HasSlug;

    protected $table = "citas";

    protected $fillable = [
        'consultorio_id',
        'paciente_id',
        'medico_id',
        'servicio_id',
        'status'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nombre')
            ->saveSlugsTo('slug');
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class,'paciente_id');
    }

    public function servicio()
    {
        return $this->belongsTo(servicio::class,'servicio_id');
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class,'medico_id');
    }
}
