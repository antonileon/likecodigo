<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Http\Requests\StoreEmpresaRequest;
use App\Http\Requests\UpdateEmpresaRequest;
use Alert;

class EmpresaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:empresas.index')->only('index');
        $this->middleware('can:empresas.create')->only('create','store');
        $this->middleware('can:empresas.show')->only('show');
        $this->middleware('can:empresas.edit')->only('edit','update');
        $this->middleware('can:empresas.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('empresas.index');
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

        $users = \DB::table('empresas');
        $total = $users->count();
        $totalFilter = Empresa::select('id','nombre','slug','numero_identificacion','email','telefono','status');
        if (!empty($searchValue)) {
            $totalFilter = $totalFilter->where('nombre','like','%'.$searchValue.'%');
            $totalFilter = $totalFilter->orWhere('numero_identificacion','like','%'.$searchValue.'%');
            $totalFilter = $totalFilter->orWhere('email','like','%'.$searchValue.'%');
        }
        $totalFilter = $totalFilter->count();


        $arrData = Empresa::select('id','nombre','slug','numero_identificacion','email','telefono','status');
        $arrData = $arrData->skip($start)->take($rowPerPage);
        $arrData = $arrData->orderBy($columnName,$columnSortOrder);
        if (!empty($searchValue)) {
            $arrData = $arrData->where('nombre','like','%'.$searchValue.'%');
            $arrData = $arrData->orWhere('numero_identificacion','like','%'.$searchValue.'%');
            $arrData = $arrData->orWhere('email','like','%'.$searchValue.'%');
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
            $ver = '<a href="empresas/'.$key->slug.'" title="Ver datos de empresa">'.strtoupper($key->nombre).'</a>';
            if ($key->status=="Activo") {
                $status = '<span class="badge bg-success"><i class="fa fa-check me-1"></i>'.$key->status.'</span>';
            } else {
                $status = '<span class="badge bg-danger"><i class="fa fa-times-circle me-1"></i>'.$key->status.'</span>';
            }
            $response['data'][] = [
                "nombre"                    => $ver,
                "numero_identificacion"     => $key->numero_identificacion,
                "email"                     => $key->email,
                "numero_consultorios"       => $key->consultorios->count(),
                "numero_usuarios"           => $key->usuarios->count(),
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
                <a href="empresas/'.$slug.'" class="dropdown-item" title="Ver datos de empresa">
                    <i class="fa fa-search"></i> Ver
                </a>
                <a href="empresas/'.$slug.'/edit" class="dropdown-item" title="Editar datos de empresa">
                    <i class="fa fa-pencil"></i> Editar
                </a>
                <a href="javascript:void(0);" data-mc="'.$slug.'" id="eliminarEmpresa" title="Eliminar empresa" class="dropdown-item">
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
        return view('empresas.create',[
            'empresa'   => new Empresa
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmpresaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmpresaRequest $request)
    {
        $empresa = new Empresa();
        $empresa->nombre=$request->nombre;
        $empresa->numero_identificacion=$request->numero_identificacion;
        $empresa->email=$request->email;
        $empresa->telefono=$request->telefono;
        $empresa->save();
        
        toast('Empresa '.strtoupper($empresa->nombre).' registrada con éxito.','success');
        return redirect()->route('empresas.show', $empresa);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        return view('empresas.show', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        return view('empresas.edit', compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmpresaRequest  $request
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmpresaRequest $request, Empresa $empresa)
    {
        $empresa = Empresa::findOrFail($empresa->id);
        $empresa->nombre=$request->nombre;
        $empresa->numero_identificacion=$request->numero_identificacion;
        $empresa->email=$request->email;
        $empresa->telefono=$request->telefono;
        $empresa->save();
        
        toast('Empresa '.strtoupper($empresa->nombre).' modificada con éxito.','success');
        return redirect()->route('empresas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();
        return response()->json(['mensaje'=>"Empresa eliminada con éxito.",'icono'=>'success']);
    }
}
