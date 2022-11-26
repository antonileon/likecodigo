<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Http\Requests\StoreCitaRequest;
use App\Http\Requests\UpdateCitaRequest;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('citas.index');
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

        $citas = Cita::select([
            'id',
            'consultorio_id',
            'paciente_id',
            'medico_id',
            'servicio_id',
            'status'
        ]);
        /*if (\Auth::User()->tipo_usuario_id!=1) {
            $citas = $citas->where('empresa_id',\Auth::User()->empresa->id);
        }*/
        $total = $citas->count();
        $totalFilter = Cita::select([
                'id',
                'consultorio_id',
                'paciente_id',
                'medico_id',
                'servicio_id',
                'status'
            ]);
        /*if (\Auth::User()->tipo_usuario_id!=1) {
            $totalFilter = $totalFilter->where('empresa_id',\Auth::User()->empresa->id);
        }*/
        if (!empty($searchValue)) {
            $totalFilter = $totalFilter->where('especialidad','like','%'.$searchValue.'%');
        }
        $totalFilter = $totalFilter->count();

        $arrData = Cita::select([
                'id',
                'consultorio_id',
                'paciente_id',
                'medico_id',
                'servicio_id',
                'status'
            ]);
        /*if (\Auth::User()->tipo_usuario_id!=1) {
            $arrData = $arrData->where('empresa_id',\Auth::User()->empresa->id);
        }*/
        $arrData = $arrData->skip($start)->take($rowPerPage);
        $arrData = $arrData->orderBy($columnName,$columnSortOrder);
        if (!empty($searchValue)) {
            $arrData = $arrData->where('especialidad','like','%'.$searchValue.'%');
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
                "id"       => $key->id,
                "paciente" => strtoupper($key->paciente->persona->nombre),
                "servicio" => $key->servicio->servicio,
                "costo"    => '',
                "fecha"    => '',
                "hora"     => '',
                "medico"   => $key->medico->persona->nombre,
                "estado"   => $key->status,
                "acciones" => $this->accionesIndex($key->slug)
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
     * @param  \App\Http\Requests\StoreCitaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCitaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function show(Cita $cita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function edit(Cita $cita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCitaRequest  $request
     * @param  \App\Models\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCitaRequest $request, Cita $cita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cita $cita)
    {
        //
    }
}
