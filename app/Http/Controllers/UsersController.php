<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TipoDocumento;
use App\Models\TipoUsuario;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
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

        if (\Auth::User()->tipo_usuario_id!=1) {
            $usuarios = User::where('empresa_id',\Auth::User()->empresa->id);
        } else {
            $usuarios = User::all();
        }
        $total = $usuarios->count();
        $totalFilter = User::select('id','slug','nombre','apellido','email','tipo_usuario_id','empresa_id','status');
        if (!empty($searchValue)) {
            $totalFilter = $totalFilter->where('nombre','like','%'.$searchValue.'%');
            $totalFilter = $totalFilter->orWhere('apellido','like','%'.$searchValue.'%');
            $totalFilter = $totalFilter->orWhere('email','like','%'.$searchValue.'%');
        }
        if (\Auth::User()->tipo_usuario_id!=1) {
            $totalFilter = $totalFilter->where('empresa_id',\Auth::User()->empresa->id);
        }
        $totalFilter = $totalFilter->count();


        $arrData =User::select('id','slug','nombre','apellido','email','tipo_usuario_id','empresa_id','status');
        $arrData = $arrData->skip($start)->take($rowPerPage);
        $arrData = $arrData->orderBy($columnName,$columnSortOrder);
        if (!empty($searchValue)) {
            $arrData = $arrData->where('nombre','like','%'.$searchValue.'%');
            $arrData = $arrData->orWhere('apellido','like','%'.$searchValue.'%');
            $arrData = $arrData->orWhere('email','like','%'.$searchValue.'%');
        }
        if (\Auth::User()->tipo_usuario_id!=1) {
            $arrData = $arrData->where('empresa_id',\Auth::User()->empresa->id);
        }
        $arrData = $arrData->orderby('id','DESC')->get();

        $response =[];
        $response = array(
            "draw"              => intval($draw),
            "recordsTotal"      => $total,
            "recordsFiltered"   => $totalFilter,
            "data"              => [],
        );
        foreach($arrData as $key){
            if ($key->status=="Activo") {
                $status = '<span class="badge bg-success">'.$key->status.'</span>';
            } else {
                $status = '<span class="badge bg-success">'.$key->status.'</span>';
            }
            
            $response['data'][] = [
                "nombre"            => $key->nombre.' '.$key->apellido,
                "email"             => $key->email,
                "tipo_usuario_id"   => $key->tipo_usuario->nombre,
                "empresa_id"        => empty($key->empresa->nombre)?'N/A':$key->empresa->nombre,
                "status"            => $status,
                "acciones"          => $this->accionesIndex($key->slug)
            ];
        }

        return response()->json($response);
    }

    public function accionesIndex($slug)
    {
        $acciones ='<button type="button" class="btn btn-primary dropdown-toggle btn-sm btn-block" data-toggle="dropdown">Acciones</button><div class="dropdown-menu">';
        $acciones .= '<a href="users/'.$slug.'" class="dropdown-item" title="Ver datos del usuario"><i class="fa fa-search"></i> Ver</a>';
        $acciones .= '<a href="users/'.$slug.'/edit" class="dropdown-item" title="Editar datos del usuario"><i class="fa fa-pencil"></i> Editar</a>';
        $acciones .= '<a href="javascript:void(0);" data-mc="'.$slug.'" id="eliminarUsuario"  title="Eliminar usuario" class="dropdown-item"><i class="fa fa-trash"></i> Eliminar</a>';
        $acciones .= '</div>';
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
        $tipoUsuarios = TipoUsuario::whereIn('nombre',['Administrador','Secretario(a)'])->get();
        return view('users.create',[
            'user'              => new User,
        ], compact('tipoDocumentos','tipoUsuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['mensaje'=>"Usuario eliminado con éxito.",'icono'=>'success']);
    }

    public function cambiarTema(Request $request)
    {
        $user = User::findOrFail(\Auth::User()->id);
        $user->tema = $request->tema;
        $user->save();

        return response()->json($request->tema);
    }
}
