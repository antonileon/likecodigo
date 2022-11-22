<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;
use App\Http\Requests\StoreServicioRequest;
use App\Http\Requests\UpdateServicioRequest;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('servicios.index');
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

        $servicios = Servicio::select([
            'id',
            'empresa_id',
            'slug',
            'servicio',
            'precio'
        ]);
        if (\Auth::User()->tipo_usuario_id!=1) {
            $servicios = $servicios->where('empresa_id',\Auth::User()->empresa->id);
        }
        $total = $servicios->count();
        $totalFilter = Servicio::select([
                'id',
                'empresa_id',
                'slug',
                'servicio',
                'precio'
            ]);
        if (\Auth::User()->tipo_usuario_id!=1) {
            $totalFilter = $totalFilter->where('empresa_id',\Auth::User()->empresa->id);
        }
        if (!empty($searchValue)) {
            $totalFilter = $totalFilter->where('servicio','like','%'.$searchValue.'%');
        }
        $totalFilter = $totalFilter->count();

        $arrData = Servicio::select([
                'id',
                'empresa_id',
                'slug',
                'servicio',
                'precio'
            ]);
        if (\Auth::User()->tipo_usuario_id!=1) {
            $arrData = $arrData->where('empresa_id',\Auth::User()->empresa->id);
        }
        $arrData = $arrData->skip($start)->take($rowPerPage);
        $arrData = $arrData->orderBy($columnName,$columnSortOrder);
        if (!empty($searchValue)) {
            $arrData = $arrData->where('servicio','like','%'.$searchValue.'%');
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
                "servicio" => $key->servicio,
                "precio"   => $key->precio,
                "acciones" => $this->accionesIndex($key->slug)
            ];
        }

        return response()->json($response);
    }

    public function accionesIndex($slug)
    {
        $editar = '';
        if (\Auth::User()->can('servicios.edit')) {
            $editar = '<button data-id="'.$slug.'" class="dropdown-item" title="Editar datos" id="editarServicio"><i class="fa fa-pencil"></i> Editar</button>';
        }

        $acciones ='
            <button type="button" class="btn btn-sm btn-primary btn-block" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                Acciones <i class="fa fa-angle-down opacity-50 ms-1"></i>
            </button>
            <div class="dropdown-menu">
                '.$editar.'
                <a href="javascript:void(0);" data-mc="'.$slug.'" title="Eliminar servicio" id="eliminarServicio" class="dropdown-item">
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
     * @param  \App\Http\Requests\StoreServicioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $servicio = Servicio::where([['servicio',$request->servicio],['empresa_id',\Auth::User()->empresa_id]])->first();
            if (!empty($servicio)) {
                $return = [
                    'tipo'    => 'warning',
                    'mensaje' => 'El servicio <b>'.strtoupper($request->servicio).'</b> ya se encuentra registrado.'
                ];
            } else {
                $servicio = new Servicio;
                $servicio->empresa_id = \Auth::User()->empresa_id;
                $servicio->servicio = $request->servicio;
                $servicio->precio = $request->precio;
                if ($servicio->save()) {
                    $return = [
                        'tipo'    => 'success',
                        'mensaje' => 'Servicio registrado exitosamente.'
                    ];
                } else {
                    $return = [
                        'tipo'    => 'error',
                        'mensaje' => '¡Error! Servicio no registrado, por favor inténtelo nuevamente.'
                    ];
                }

            }
            return response()->json($return);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function show(Servicio $servicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function edit(Servicio $servicio)
    {
        return response()->json($servicio);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServicioRequest  $request
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servicio $servicio)
    {
        $servicio = Servicio::findOrFail($servicio->id);
        $servicio->servicio=$request->servicio;
        $servicio->precio=$request->precio;
        if ($servicio->save()) {
            $return = [
                'tipo'    => 'success',
                'mensaje' => 'Servicio actualizado exitosamente.'
            ];
        } else {
            $return = [
                'tipo'    => 'error',
                'mensaje' => '¡Error! Servicio no actualizado, por favor inténtelo nuevamente.'
            ];
        }
        return response()->json($return);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servicio $servicio)
    {
        if ($servicio->delete()) {
            $return = [
                'tipo'    => 'success',
                'mensaje' => 'Servicio eliminado exitosamente.'
            ];
        } else {
            $return = [
                'tipo'    => 'error',
                'mensaje' => '¡Error! Servicio no eliminado, por favor inténtelo nuevamente.'
            ];   
        }
        return response()->json($return);
    }
}
