<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Empresa;
use App\Models\TipoUsuario;
use App\Models\Medico;
use App\Models\Paciente;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles, HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'empresa_id',
        'tipo_usuario_id',
        'nombre',
        'apellido',
        'nombre_usuario',
        'slug',
        'status',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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

    public function empresa()
    {
        return $this->belongsTo(Empresa::class,'empresa_id')->withDefault();
    }

    public function tipo_usuario()
    {
        return $this->belongsTo(TipoUsuario::class,'tipo_usuario_id')->withDefault();
    }
    
    public function medico()
    {
        return $this->hasOne(Medico::class);
    }

    public function paciciente()
    {
        return $this->hasOne(Paciente::class);
    }
}
