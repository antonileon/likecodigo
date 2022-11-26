<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Menu;
use App\Models\SubMenu;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Route;

class SubMenu extends Model
{
    use HasFactory, Notifiable;
    use HasRoles, HasSlug;

    protected $table = "sub_menus";

    protected $fillable = [
        'menu_id',
        'slug',
        'nombre',
        'descripcion',
        'ruta',
        'url',
        'orden',
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

    public function menu()
    {
        return $this->belongsTo(Menu::class,'menu_id')->withDefault();
    }
}
