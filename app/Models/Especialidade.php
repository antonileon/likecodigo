<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Empresa;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Especialidade extends Model
{
    use HasFactory, Notifiable;
    use HasRoles, HasSlug;

    protected $table = "especialidades";

    protected $fillable = [
        'especialidad',
        'slug'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('especialidad')
            ->saveSlugsTo('slug');
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function medicos()
    {
        return $this->belongsToMany('App\Models\Medicos');
    }
}
