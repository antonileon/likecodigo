<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Http\Requests\StorePacienteRequest;
use App\Http\Requests\UpdatePacienteRequest;
use App\Models\TipoDocumento;
use App\Models\Persona;
use App\Models\User;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pacientes.index');
    }

    public function getIndex(Request $request)
    {
        $draw               =       $request->get('draw'); // Internal use
        $start              =       $request->get("start"); // where to start next records for pagination
        $rowPerPage         =       $request->get("length"); // How many recods needed per page for pagination
        $orderArray         =       $request->get('order');
        $columnNameArray    =       $request->get('columns'); // It will give us columns array                            
        $searchArray        =       $request->get('search');
        $columnIndex        =       $orderArray[0]['column'];
        $columnName         =       $columnNameArray[$columnIndex]['data']; 
        $columnSortOrder    =       $orderArray[0]['dir']; // This will get us order direction(ASC/DESC)
        $searchValue        =       $searchArray['value']; // This is search value 

        $pacientes = Paciente::select([
            'pacientes.id',
            'users.empresa_id'
        ])
        ->join('users','users.id','=','pacientes.user_id');
        if (\Auth::User()->tipo_usuario_id!=1) {
            $pacientes = $pacientes->where('users.empresa_id',\Auth::User()->empresa->id);
        }
        $total = $pacientes->count();
        $totalFilter = Paciente::select([
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
            ->join('users','users.id','=','pacientes.user_id');
        if (!empty($searchValue)) {
            $totalFilter = $totalFilter->where('personas.nombre','like','%'.$searchValue.'%');
            $totalFilter = $totalFilter->orWhere('personas.apellido','like','%'.$searchValue.'%');
            $totalFilter = $totalFilter->orWhere('personas.numero_identificacion','like','%'.$searchValue.'%');
        }
        if (\Auth::User()->tipo_usuario_id!=1) {
            $totalFilter = $totalFilter->where('users.empresa_id',\Auth::User()->empresa->id);
        }
        $totalFilter = $totalFilter->count();


        $arrData = Paciente::select([
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
            ->join('users','users.id','=','pacientes.user_id');
        $arrData = $arrData->skip($start)->take($rowPerPage);
        $arrData = $arrData->orderBy($columnName,$columnSortOrder);
        if (!empty($searchValue)) {
            $arrData = $arrData->where('personas.nombre','like','%'.$searchValue.'%');
            $arrData = $arrData->orWhere('personas.apellido','like','%'.$searchValue.'%');
            $arrData = $arrData->orWhere('personas.numero_identificacion','like','%'.$searchValue.'%');
        }
        if (\Auth::User()->tipo_usuario_id!=1) {
            $arrData = $arrData->where('users.empresa_id',\Auth::User()->empresa->id);
        }
        $arrData = $arrData->orderby('id','DESC')->get();

        $response =[];
        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => $total,
            "recordsFiltered" => $totalFilter,
            "data" => [],
        );
        foreach($arrData as $key){
            $ver = '<a href="pacientes/'.$key->slug.'" title="Ver datos del médico">'.$key->nombre.' '.$key->apellido.'</a>';
            if ($key->status=="Activo") {
                $status = '<span class="badge bg-success">'.$key->status.'</span>';
            } else {
                $status = '<span class="badge bg-danger">'.$key->status.'</span>';
            }

            $telefono = '<a href="https://api.whatsapp.com/send?phone='.$key->telefono.'&text=Hola '.$key->nombre.' '.$key->apellido.'" title="Enviar mensaje al paciente." target="_blank" class="text-success"><span class="badge bg-success">'.$key->telefono.' <i class="fab fa-whatsapp"></i></span></a>';
            $email = '<a href="mailto:'.$key->email.'">'.$key->email.'</a>';
            $response['data'][] = [
                "nombre"                    => $ver,
                "numero_identificacion"     => $key->numero_identificacion,
                "telefono"                  => $telefono,
                "email"                     => $email,
                "acciones"                  => $this->accionesIndex($key->slug)
            ];
        }

        return response()->json($response);
    }

    public function accionesIndex($slug)
    {
        $acciones ='
            <button type="button" class="btn btn-sm btn-primary btn-block" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                Acciones <i class="fa fa-angle-down opacity-50 ms-1"></i>
            </button>
            <div class="dropdown-menu">
                <a href="pacientes/'.$slug.'" class="dropdown-item" title="Ver datos del paciente">
                    <i class="fa fa-search"></i> Ver
                </a>
                <a href="pacientes/'.$slug.'/edit" class="dropdown-item" title="Editar datos del paciente">
                    <i class="fa fa-pencil"></i> Editar
                </a>
                <a href="javascript:void(0);" data-mc="'.$slug.'" title="Eliminar paciente" id="eliminarPaciente" class="dropdown-item">
                    <i class="fa fa-trash"></i> Eliminar
                </a>
            </div>';
            return $acciones;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoDocumentos = TipoDocumento::all();
        return view('pacientes.create',[
                'paciente'   => new Paciente
            ],compact('tipoDocumentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePacienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePacienteRequest $request)
    {
        $persona = Persona::create([
            'tipo_documento_id'         => $request->tipo_documento_id,
            'numero_identificacion'     => $request->numero_identificacion,
            'nombre'                    => $request->nombre,
            'apellido'                  => $request->apellido,
            'fecha_nacimiento'          => $request->fecha_nacimiento,
            'telefono'                  => $request->telefono,
            'genero'                    => 'Otros',
            'direccion'                 => '$request->direccion'
        ]);

        $usuario = User::create([
            'empresa_id'                => \Auth::User()->empresa->id,
            'tipo_usuario_id'           => 4,
            'nombre'                    => $request->nombre,
            'apellido'                  => $request->apellido,
            'nombre_usuario'            => $request->email,
            'email'                     => $request->email,
            'password'                  => bcrypt($request->password)
        ]);

        $medico = Paciente::create([
            'user_id'                   => $usuario->id,
            'persona_id'                => $persona->id,
            'slug'                      => $request->nombre
        ]);

        toast('Paciente '.strtoupper($request->nombre).' registrado con éxito.','success');
        return redirect()->route('pacientes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function edit(Paciente $paciente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePacienteRequest  $request
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePacienteRequest $request, Paciente $paciente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paciente $paciente)
    {
        //
    }
}
