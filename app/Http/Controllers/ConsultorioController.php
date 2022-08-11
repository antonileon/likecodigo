<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultorio;
use App\Http\Requests\StoreConsultorioRequest;
use App\Http\Requests\UpdateConsultorioRequest;
use App\Models\Empresa;
use App\Models\User;

class ConsultorioController extends Controller
{
    protected $idEmpresa;

    public function __construct()
    {
        //$this->idEmpresa = ;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('');
        return view('consultorios.index');
    }

    public function getIndex(Request $request)
    {
        $draw               =       $request->get('draw'); // Internal use
        $start              =       $request->get("start"); // where to start next records for pagination
        $rowPerPage         =       $request->get("length"); // How many recods needed per page for pagination
        $orderArray         =       $request->get('order');
        $columnNameArray    =       $request->get('columns'); // It will give us columns array                            
        $searchArray        =       $request->get('search');
        $columnIndex        =       $orderArray[0]['column'];  // This will let us know,
                                                            // which column index should be sorted 
                                                            // 0 = id, 1 = name, 2 = email , 3 = created_at

        $columnName         =       $columnNameArray[$columnIndex]['data']; // Here we will get column name, 
                                                                        // Base on the index we get

        $columnSortOrder    =       $orderArray[0]['dir']; // This will get us order direction(ASC/DESC)
        $searchValue        =       $searchArray['value']; // This is search value 

        if (\Auth::User()->tipo_usuario_id!=1) {
            $consultorios = Consultorio::select('empresa_id')
            ->where('empresa_id',\Auth::User()->empresa->id);
        } else {
            $consultorios = Consultorio::all();
        }
        $total = $consultorios->count();
        $totalFilter = Consultorio::select('id','nombre','slug','telefono');
        if (!empty($searchValue)) {
            $totalFilter = $totalFilter->where('nombre','like','%'.$searchValue.'%');
            $totalFilter = $totalFilter->orWhere('telefono','like','%'.$searchValue.'%');
        }
        if (\Auth::User()->tipo_usuario_id!=1) {
            $totalFilter = $totalFilter->where('empresa_id',\Auth::User()->empresa->id);
        }
        $totalFilter = $totalFilter->count();


        $arrData =Consultorio::select('id','nombre','slug','telefono');
        $arrData = $arrData->skip($start)->take($rowPerPage);
        $arrData = $arrData->orderBy($columnName,$columnSortOrder);
        if (!empty($searchValue)) {
            $arrData = $arrData->where('nombre','like','%'.$searchValue.'%');
            $arrData = $arrData->orWhere('telefono','like','%'.$searchValue.'%');
        }
        if (\Auth::User()->tipo_usuario_id!=1) {
            $arrData = $arrData->where('empresa_id',\Auth::User()->empresa->id);
        }
        $arrData = $arrData->get();


        $response =[];
        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => $total,
            "recordsFiltered" => $totalFilter,
            "data" => [],
        );
        foreach($arrData as $key){
            $acciones ='
                <button type="button" class="btn btn-sm btn-primary btn-block" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                    Acciones <i class="fa fa-angle-down opacity-50 ms-1"></i>
                </button>
                <div class="dropdown-menu">
                    <a href="consultorios/'.$key->slug.'" class="dropdown-item" title="Ver datos del consultorio">
                        <i class="fa fa-search"></i> Ver
                    </a>
                    <a href="consultorios/'.$key->slug.'/edit" class="dropdown-item" title="Editar datos del consultorio">
                        <i class="fa fa-pencil"></i> Editar
                    </a>
                    <a href="javascript:void(0);" data-mc="'.$key->slug.'" id="eliminarConsultorio" title="Eliminar consultorio" class="dropdown-item">
                        <i class="fa fa-trash"></i> Eliminar
                    </a>
                </div>';
            $response['data'][] = [
                "nombre"=>$key->nombre,
                "telefono"=>$key->telefono,
                "acciones"=>$acciones
            ];
        }

        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('consultorios.create',[
            'consultorio' => new Consultorio,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreConsultorioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreConsultorioRequest $request)
    {
        $consultorio = new Consultorio();
        $consultorio->empresa_id=$request->empresa_id;
        $consultorio->nombre=$request->nombre;
        $consultorio->telefono=$request->telefono;
        $consultorio->direccion=$request->direccion;
        $consultorio->save();

        toast('Consultorio '.strtoupper($consultorio->nombre).' registrado con éxito.','success');
        return redirect()->route('consultorios.show', $consultorio);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consultorio  $consultorio
     * @return \Illuminate\Http\Response
     */
    public function show(Consultorio $consultorio)
    {
        return view('consultorios.show',[
            'consultorio'       => $consultorio
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consultorio  $consultorio
     * @return \Illuminate\Http\Response
     */
    public function edit(Consultorio $consultorio)
    {
        return view('consultorios.edit', compact('consultorio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateConsultorioRequest  $request
     * @param  \App\Models\Consultorio  $consultorio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConsultorioRequest $request, Consultorio $consultorio)
    {
        $consultorio = Consultorio::findOrFail($consultorio->id);
        $consultorio->nombre=$request->nombre;
        $consultorio->telefono=$request->telefono;
        $consultorio->direccion=$request->direccion;
        $consultorio->save();

        toast('Consultorio '.strtoupper($consultorio->nombre).' modificado con éxito.','success');
        return redirect()->route('consultorios.show', $consultorio);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consultorio  $consultorio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consultorio $consultorio)
    {
        $consultorio->delete();
        return response()->json(['mensaje'=>"Consultorio eliminado con éxito.",'icono'=>'success']);
    }

    public function buscarEmpresas(Request $request)
    {
        $input = $request->all();
        if (!empty($input['query'])) {
                $data = Empresa::select(["id", "nombre", "numero_identificacion"])
                ->where("nombre", "LIKE", "%{$input['query']}%")
                ->orWhere("numero_identificacion", "LIKE", "%{$input['query']}%")->get();
        } else {
            $data = Empresa::select(["id", "nombre", "numero_identificacion"])->get();
        }

        $empresas = [];
        if (count($data) > 0) {
            foreach ($data as $empresa) {
                $empresas[] = array(
                    "id" => $empresa->id,
                    "text" => $empresa->nombre.' | '.$empresa->numero_identificacion,
                );
            }
        }
        return response()->json($empresas);
    }
}
