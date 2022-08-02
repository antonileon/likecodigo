<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalMedicos = Medico::select([
            'medicos.id',
            'users.empresa_id'
        ])
        ->join('users','users.id','=','medicos.user_id');
        if (\Auth::User()->tipo_usuario_id!=1) {
            $totalMedicos = $totalMedicos->where('users.empresa_id',\Auth::User()->empresa->id);
        }
        $totalMedicos = $totalMedicos->count();

        return view('home', compact('totalMedicos'));
    }
}
