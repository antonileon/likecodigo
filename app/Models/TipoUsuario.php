<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Models\User;

class TipoUsuario extends Model
{
    use HasFactory;
    use HasSlug;

    protected $table = "tipo_usuarios";

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

    public function usuarios()
    {
        return $this->hasMany(User::class);
    }
}
