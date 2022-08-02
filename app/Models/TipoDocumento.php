<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Models\Persona;

class TipoDocumento extends Model
{
    use HasFactory;
    use HasSlug;

    protected $table = "tipo_documentos";

    protected $fillable = [
        'nombre'
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
        return $this->hasMany(Persona::class);
    }
}
