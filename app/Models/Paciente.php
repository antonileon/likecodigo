<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Models\TipoDocumento;
use App\Models\Persona;
use App\Models\User;
use App\Models\Cita;

class Paciente extends Model
{
    use HasFactory;
    use HasSlug;


    protected $table = "pacientes";

    protected $fillable = [
        'persona_id',
        'user_id',
        'slug'
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

    public function persona()
    {
        return $this->belongsTo(Persona::class,'persona_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function cita()
    {
        return $this->hasOne(Cita::class);
    }
}
