<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('permissions.index');
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

        $users = \DB::table('permissions');
        $total = $users->count();
        $totalFilter = Permission::select('id','name','description');
        if (!empty($searchValue)) {
            $totalFilter = $totalFilter->where('name','like','%'.$searchValue.'%');
            $totalFilter = $totalFilter->orWhere('description','like','%'.$searchValue.'%');
        }
        $totalFilter = $totalFilter->count();


        $arrData =Permission::select('id','name','description');
        $arrData = $arrData->skip($start)->take($rowPerPage);
        $arrData = $arrData->orderBy($columnName,$columnSortOrder);
        if (!empty($searchValue)) {
            $arrData = $arrData->where('name','like','%'.$searchValue.'%');
            $arrData = $arrData->orWhere('description','like','%'.$searchValue.'%');
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
            $ver = '<a href="empresas/'.$key->id.'" title="'.$key->description.'">'.$key->description.'</a>';
            $response['data'][] = [
                "description"               => $ver,
                "name"                      => $key->name,
                "acciones"                  => $this->accionesIndex($key->id)
            ];
        }

        return response()->json($response);
    }

    public function accionesIndex($id)
    {
        $acciones ='
            <button type="button" class="btn btn-primary dropdown-toggle btn-sm btn-block" data-toggle="dropdown">Acciones</button>
            <div class="dropdown-menu">
                <a href="permissions/'.$id.'" class="dropdown-item" title="Ver permiso">
                    <i class="fa fa-pencil"></i> Ver
                </a>
                <a href="permissions/'.$id.'/edit" class="dropdown-item" title="Editar permiso">
                    <i class="fa fa-pencil"></i> Editar
                </a>
                <a href="javascript:void(0);" data-mc="'.$id.'" title="Eliminar permiso" class="dropdown-item" id="eliminarPermiso">
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
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Permission::create($request->all());
        toast('Permiso '.strtoupper($request->name).' registrado con éxito.','success');
        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return view('permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('permissions.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $permission->update($request->only('name','description'));
        toast('Permiso '.strtoupper($request->description).' modificado con éxito.','success');
        return redirect()->route('permissions.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return response()->json(['mensaje'=>"Permiso eliminado con éxito.",'icono'=>'success']);
    }
}
