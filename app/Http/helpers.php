<?php
use App\Models\User;

function tema()
{
	$tema = User::where('id',\Auth::User()->id)->select('tema')->first();
	return $tema->tema;
}