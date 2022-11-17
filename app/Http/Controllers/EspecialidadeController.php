<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEspecialidadeRequest;
use App\Http\Requests\UpdateEspecialidadeRequest;

class EspecialidadeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:especialidades.edit')->only('edit','update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(\Auth::User()->can('Editar especialidad'));
        return view('especialidades.index');
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

        $especialidades = Especialidade::select([
            'id',
            'empresa_id',
            'especialidad',
            'slug'
        ]);
        if (\Auth::User()->tipo_usuario_id!=1) {
            $especialidades = $especialidades->where('empresa_id',\Auth::User()->empresa->id);
        }
        $total = $especialidades->count();
        $totalFilter = Especialidade::select([
                'id',
                'empresa_id',
                'especialidad',
                'slug'
            ]);
        if (\Auth::User()->tipo_usuario_id!=1) {
            $totalFilter = $totalFilter->where('empresa_id',\Auth::User()->empresa->id);
        }
        if (!empty($searchValue)) {
            $totalFilter = $totalFilter->where('personas.nombre','like','%'.$searchValue.'%');
            $totalFilter = $totalFilter->orWhere('personas.apellido','like','%'.$searchValue.'%');
            $totalFilter = $totalFilter->orWhere('personas.numero_identificacion','like','%'.$searchValue.'%');
        }
        $totalFilter = $totalFilter->count();

        $arrData = Especialidade::select([
                'id',
                'empresa_id',
                'especialidad',
                'slug'
            ]);
        if (\Auth::User()->tipo_usuario_id!=1) {
            $arrData = $arrData->where('empresa_id',\Auth::User()->empresa->id);
        }
        $arrData = $arrData->skip($start)->take($rowPerPage);
        $arrData = $arrData->orderBy($columnName,$columnSortOrder);
        if (!empty($searchValue)) {
            $arrData = $arrData->where('personas.nombre','like','%'.$searchValue.'%');
            $arrData = $arrData->orWhere('personas.apellido','like','%'.$searchValue.'%');
            $arrData = $arrData->orWhere('personas.numero_identificacion','like','%'.$searchValue.'%');
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
            $response['data'][] = [
                "id"              => $key->id,
                "especialidad"    => $key->especialidad,
                "cantidadMedicos" => $key->medicos->count(),
                "acciones"        => $this->accionesIndex($key->slug)
            ];
        }

        return response()->json($response);
    }

    public function accionesIndex($slug)
    {
        $editar = '';
        if (\Auth::User()->can('especialidades.edit')) {
            $editar = '<button data-id="'.$slug.'" class="dropdown-item" title="Editar datos" id="editarEspecialidad"><i class="fa fa-pencil"></i> Editar</button>';
        }

        $acciones ='
            <button type="button" class="btn btn-sm btn-primary btn-block" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                Acciones <i class="fa fa-angle-down opacity-50 ms-1"></i>
            </button>
            <div class="dropdown-menu">
                '.$editar.'
                <a href="javascript:void(0);" data-mc="'.$slug.'" title="Eliminar especialidad" id="eliminarEspecialidad" class="dropdown-item">
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEspecialidadeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $especialidad = Especialidade::where([['especialidad',$request->especialidad],['empresa_id',\Auth::User()->empresa_id]])->first();
        if (!empty($especialidad)) {
            $return = [
                'tipo'    => 'warning',
                'mensaje' => 'La especialidad <b>'.strtoupper($request->especialidad).'</b> ya se encuentra registrada.'
            ];
        } else {
            $especialidad = new Especialidade;
            $especialidad->empresa_id = \Auth::User()->empresa_id;
            $especialidad->especialidad = $request->especialidad;
            if ($especialidad->save()) {
                $return = [
                    'tipo'    => 'success',
                    'mensaje' => 'Especialidad registrada exitosamente.'
                ];
            } else {
                $return = [
                    'tipo'    => 'error',
                    'mensaje' => '¡Error! Especialidad no registrada, por favor inténtelo nuevamente.'
                ];
            }

        }
        return response()->json($return);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Especialidade  $especialidade
     * @return \Illuminate\Http\Response
     */
    public function show(Especialidade $especialidade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Especialidade  $especialidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Especialidade $especialidade)
    {
        return response()->json($especialidade);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEspecialidadeRequest  $request
     * @param  \App\Models\Especialidade  $especialidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Especialidade $especialidade)
    {
        $especialidade = Especialidade::findOrFail($especialidade->id);
        $especialidade->especialidad=$request->especialidad;
        if ($especialidade->save()) {
            $return = [
                'tipo'    => 'success',
                'mensaje' => 'Especialidad actualizada exitosamente.'
            ];
        } else {
            $return = [
                'tipo'    => 'error',
                'mensaje' => '¡Error! Especialidad no actualizada, por favor inténtelo nuevamente.'
            ];
        }
        return response()->json($return);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Especialidade  $especialidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Especialidade $especialidade)
    {
        if ($especialidade->delete()) {
            $return = [
                'tipo'    => 'success',
                'mensaje' => 'Especialidad eliminada exitosamente.'
            ];
        } else {
            $return = [
                'tipo'    => 'error',
                'mensaje' => '¡Error! Especialidad no eliminada, por favor inténtelo nuevamente.'
            ];   
        }
        return response()->json($return);
    }
}
