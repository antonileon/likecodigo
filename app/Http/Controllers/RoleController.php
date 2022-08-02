<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('roles.index');
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

        $users = \DB::table('roles');
        $total = $users->count();
        $totalFilter = Role::select('id','name','guard_name');
        if (!empty($searchValue)) {
            $totalFilter = $totalFilter->where('name','like','%'.$searchValue.'%');
        }
        $totalFilter = $totalFilter->count();


        $arrData =Role::select('id','name','guard_name');
        $arrData = $arrData->skip($start)->take($rowPerPage);
        $arrData = $arrData->orderBy($columnName,$columnSortOrder);
        if (!empty($searchValue)) {
            $arrData = $arrData->where('name','like','%'.$searchValue.'%');
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
            $ver = '<a href="roles/'.$key->id.'" title="Ver datos de empresa">'.$key->name.'</a>';
            $response['data'][] = [
                "name"                      => $ver,
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
                <a href="roles/'.$id.'" class="dropdown-item" title="Ver rol">
                    <i class="fa fa-search"></i> Ver
                </a>
                <a href="roles/'.$id.'/edit" class="dropdown-item" title="Editar rol">
                    <i class="fa fa-pencil"></i> Editar
                </a>
                <a href="javascript:void(0);" data-mc="'.$id.'" title="Eliminar rol" class="dropdown-item" id="eliminarRol">
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
        $permissions = Permission::all()->pluck('description', 'id');
        // dd($permissions);
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message =[
            'name.required' => 'El campo nombre es obligatorio.',
        ];
        $request->validate([
            'name'      => 'required'
        ],$message);

        $role = Role::create($request->all());
        $role->permissions()->sync($request->permissions);

        toast('Rol '.strtoupper($request->name).' registrado con éxito.','success');
        return redirect()->route('roles.edit', $role);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.show', compact('role','permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {

        $permissions = Permission::all()->pluck('description', 'id');
        $role->load('permissions');
        return view('roles.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->update($request->only('name'));

        // $role->permissions()->sync($request->input('permissions', []));
        $role->syncPermissions($request->input('permissions', []));
        toast('Rol '.strtoupper($request->description).' modificado con éxito.','success');
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['mensaje'=>"Rol eliminado con éxito.",'icono'=>'success']);
    }
}
