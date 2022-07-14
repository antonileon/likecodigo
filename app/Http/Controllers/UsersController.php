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

        $users = \DB::table('users');
        $total = $users->count();
        $totalFilter = User::select('id','nombre','apellido','email');
        if (!empty($searchValue)) {
            $totalFilter = $totalFilter->where('nombre','like','%'.$searchValue.'%');
            $totalFilter = $totalFilter->orWhere('apellido','like','%'.$searchValue.'%');
            $totalFilter = $totalFilter->orWhere('email','like','%'.$searchValue.'%');
        }
        $totalFilter = $totalFilter->count();


        $arrData =User::select('id','nombre','apellido','email');
        $arrData = $arrData->skip($start)->take($rowPerPage);
        $arrData = $arrData->orderBy($columnName,$columnSortOrder);
        if (!empty($searchValue)) {
            $arrData = $arrData->where('nombre','like','%'.$searchValue.'%');
            $arrData = $arrData->orWhere('apellido','like','%'.$searchValue.'%');
            $arrData = $arrData->orWhere('email','like','%'.$searchValue.'%');
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
            $acciones ='<button type="button" class="btn btn-primary dropdown-toggle btn-sm btn-block" data-toggle="dropdown">Acciones</button><div class="dropdown-menu"><a href="clients/'.$key->id.'" class="dropdown-item" title="Ver datos del cliente"><i class="fa fa-search"></i> Ver</a><a href="clients/'.$key->id.'/edit" class="dropdown-item" title="Editar datos del cliente"><i class="fa fa-pencil"></i> Editar</a><a href="javascript:void(0);" id="delete-compnay" onClick="deleteFunc('.$key->id.')" title="Delete" class="delete dropdown-item"><i class="fa fa-trash"></i> Eliminar</a></div>';
            $response['data'][] = [
                "nombre"            => $key->nombre,
                "apellido"          => $key->apellido,
                "email"             => $key->email,
                "acciones"          => $acciones
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
        $tipoDocumentos = TipoDocumento::all();
        $tipoUsuarios = TipoUsuario::all();
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
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
