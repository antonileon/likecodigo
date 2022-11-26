<?php
use App\Models\User;
use App\Models\Menu;

function tema()
{
	$tema = User::where('id',\Auth::User()->id)->select('tema')->first();
	return $tema->tema;
}

function calcularEdad($fechaNacimiento)
{
	$nacimiento = new DateTime($fechaNacimiento);
    $ahora = new DateTime(date("Y-m-d"));
    $diferencia = $ahora->diff($nacimiento);
    return $diferencia->format("%y");
}

function getMenu()
{
	$menu = new Menu();
	$menu = $menu->getmenu();
	return $menu;
}