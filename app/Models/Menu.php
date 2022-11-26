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

class Menu extends Model
{
    use HasFactory, Notifiable;
    use HasRoles, HasSlug;

    protected $table = "menus";

    protected $fillable = [
        'slug',
        'nombre',
        'descripcion',
        'ruta',
        'url',
        'icono',
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

    public function getMenu(){
        $routeName=Route::currentRouteName();

        $menu = Menu::where('status','1')->orderby('orden','ASC')->get();

        return [
            'menu'      => $menu,
            'routeName' => $routeName
        ];
    }

    public function subMenu()
    {
        return $this->hasMany(SubMenu::class);
    }
}
