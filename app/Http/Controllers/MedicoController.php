<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMedicoRequest;
use App\Http\Requests\UpdateMedicoRequest;
use App\Models\TipoDocumento;
use App\Models\Persona;
use App\Models\User;
use App\Models\Especialidade;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('medicos.index');
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

        $medicos = Medico::select([
            'medicos.id',
            'users.empresa_id'
        ])
        ->join('users','users.id','=','medicos.user_id');
        if (\Auth::User()->tipo_usuario_id!=1) {
            $medicos = $medicos->where('users.empresa_id',\Auth::User()->empresa->id);
        }
        $total = $medicos->count();
        $totalFilter = Medico::select([
                'medicos.id',
                'medicos.slug',
                'personas.nombre',
                'personas.apellido',
                'personas.numero_identificacion',
                'personas.telefono',
                'users.email',
                'users.empresa_id',
                'users.status'
            ])
            ->join('personas','personas.id','=','medicos.persona_id')
            ->join('users','users.id','=','medicos.user_id');
        if (!empty($searchValue)) {
            $totalFilter = $totalFilter->where('personas.nombre','like','%'.$searchValue.'%');
            $totalFilter = $totalFilter->orWhere('personas.apellido','like','%'.$searchValue.'%');
            $totalFilter = $totalFilter->orWhere('personas.numero_identificacion','like','%'.$searchValue.'%');
            $totalFilter = $totalFilter->orWhere('personas.telefono','like','%'.$searchValue.'%');
        }
        if (\Auth::User()->tipo_usuario_id!=1) {
            $totalFilter = $totalFilter->where('users.empresa_id',\Auth::User()->empresa->id);
        }
        $totalFilter = $totalFilter->count();


        $arrData = Medico::select([
                'medicos.id',
                'medicos.slug',
                'personas.nombre',
                'personas.apellido',
                'personas.numero_identificacion',
                'personas.telefono',
                'users.email',
                'users.empresa_id',
                'users.status'
            ])
            ->join('personas','personas.id','=','medicos.persona_id')
            ->join('users','users.id','=','medicos.user_id');
        $arrData = $arrData->skip($start)->take($rowPerPage);
        $arrData = $arrData->orderBy($columnName,$columnSortOrder);
        if (!empty($searchValue)) {
            $arrData = $arrData->where('personas.nombre','like','%'.$searchValue.'%');
            $arrData = $arrData->orWhere('personas.apellido','like','%'.$searchValue.'%');
            $arrData = $arrData->orWhere('personas.numero_identificacion','like','%'.$searchValue.'%');
            $arrData = $arrData->orWhere('personas.telefono','like','%'.$searchValue.'%');
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
            $ver = '<a href="medicos/'.$key->slug.'" title="Ver datos del médico">'.$key->nombre.' '.$key->apellido.'</a>';
            if ($key->status=="Activo") {
                $status = '<span class="badge bg-success">'.$key->status.'</span>';
            } else {
                $status = '<span class="badge bg-danger">'.$key->status.'</span>';
            }
            $response['data'][] = [
                "nombre"                    => $ver,
                "numero_identificacion"     => $key->numero_identificacion,
                "telefono"                  => $key->telefono,
                "email"                     => $key->email,
                "status"                    => $status,
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
                <a href="medicos/'.$slug.'" class="dropdown-item" title="Ver datos del médico">
                    <i class="fa fa-search"></i> Ver
                </a>
                <a href="medicos/'.$slug.'/edit" class="dropdown-item" title="Editar datos del médico">
                    <i class="fa fa-pencil"></i> Editar
                </a>
                <a href="javascript:void(0);" data-mc="'.$slug.'" title="Eliminar médico" id="eliminarMedico" class="dropdown-item">
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
        $especialidades = Especialidade::all();
        return view('medicos.create',[
                'medico'            => new Medico
            ],compact('tipoDocumentos','especialidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Reque,[
            'empresa'   => new Empresa
        ]);sts\StoreMedicoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMedicoRequest $request)
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
            'tipo_usuario_id'           => 3,
            'nombre'                    => $request->nombre,
            'apellido'                  => $request->apellido,
            'nombre_usuario'            => $request->email,
            'email'                     => $request->email,
            'password'                  => bcrypt($request->password)
        ]);

        $medico = Medico::create([
            'user_id'                   => $usuario->id,
            'persona_id'                => $persona->id,
            'slug'                      => $request->nombre
        ]);
        $medico->especialidades()->sync($request->especialidade_id);

        toast('Médico '.strtoupper($request->nombre).' registrado con éxito.','success');
        return redirect()->route('medicos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function show(Medico $medico)
    {
        return view('medicos.show', compact('medico'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function edit(Medico $medico)
    {
        $tipoDocumentos = TipoDocumento::all();
        $especialidades = Especialidade::all();
        return view('medicos.edit', compact('tipoDocumentos','medico','especialidades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMedicoRequest  $request
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medico $medico)
    {
        $persona = Persona::findOrFail($medico->persona_id);
        $persona->tipo_documento_id=$request->tipo_documento_id;
        $persona->numero_identificacion=$request->numero_identificacion;
        $persona->nombre=$request->nombre;
        $persona->apellido=$request->apellido;
        $persona->fecha_nacimiento=$request->fecha_nacimiento;
        $persona->save();

        $user = User::findOrFail($medico->user_id);
        $user->nombre=$request->nombre;
        $user->apellido=$request->apellido;
        $user->email=$request->email;
        $user->save();

        $medico->especialidades()->sync($request->especialidade_id);

        toast('Médico '.strtoupper($request->nombre).' modificado con éxito.','success');
        return redirect()->route('medicos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medico $medico)
    {
        $medico->persona->delete();
        $medico->user->delete();
        $medico->delete();
        return response()->json(['mensaje'=>"Médico eliminado con éxito.",'icono'=>'success']);
    }
}
