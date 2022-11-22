<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico;
use App\Models\Paciente;

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

    public function buscarPacientesAll(Request $request)
    {
        $input = $request->all();
        if (!empty($input['query'])) {
                $data = Paciente::select([
                    'pacientes.id',
                    'pacientes.slug',
                    'personas.nombre',
                    'personas.apellido',
                    'personas.numero_identificacion',
                    'personas.telefono',
                    'users.email',
                    'users.empresa_id'
                ])
                ->join('personas','personas.id','=','pacientes.persona_id')
                ->join('users','users.id','=','pacientes.user_id')
                ->where("personas.nombre", "LIKE", "%{$input['query']}%")
                ->orWhere("personas.apellido", "LIKE", "%{$input['query']}%")
                ->orWhere("personas.numero_identificacion", "LIKE", "%{$input['query']}%")
                ->orWhere("users.email", "LIKE", "%{$input['query']}%")
                ->get();
        } else {
            $data = Paciente::select([
                    'pacientes.id',
                    'pacientes.slug',
                    'personas.nombre',
                    'personas.apellido',
                    'personas.numero_identificacion',
                    'personas.telefono',
                    'users.email',
                    'users.empresa_id'
                ])
                ->join('personas','personas.id','=','pacientes.persona_id')
                ->join('users','users.id','=','pacientes.user_id')
                ->get();
        }

        $pacientes = [];
        if (count($data) > 0) {
            foreach ($data as $paciente) {
                $pacientes[] = array(
                    "id" => $paciente->id,
                    "text" => strtoupper($paciente->nombre.' '.$paciente->apellido).' | '.$paciente->numero_identificacion,
                );
            }
        }
        return response()->json($pacientes);
    }
}
