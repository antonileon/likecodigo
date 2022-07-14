<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Empresa;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Consultorio extends Model
{
    use HasFactory;
    use HasSlug;

    protected $table = "consultorios";

    protected $fillable = [
        'nombre',
        'telefono',
        'direccion'
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

    public function empresas()
    {
        return $this->belongsTo(Empresa::class)->withDefault();
    }
}
