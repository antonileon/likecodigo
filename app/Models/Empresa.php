<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Consultorio;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Empresa extends Model
{
    use HasFactory;
    use HasSlug;


    protected $table = "empresas";

    protected $fillable = [
        'nombre',
        'numero_identificacion',
        'email',
        'telefono'
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

    public function consultorios()
    {
        return $this->hasMany(Consultorio::class);
    }
}
