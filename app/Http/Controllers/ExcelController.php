<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\Paciente;

class ExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pacientes()
    {
        // dd('hola');
        // Load users
        // $users = Paciente::all();

        // // Export all users
        // return (new FastExcel($users))->download('file.xlsx');

        $list = collect([
            [ 'id' => 1, 'name' => 'Jane dsa sa dsa dsa dsa ds das' ],
            [ 'id' => 2, 'name' => 'John' ],
        ]);

        return (new FastExcel($list))->download('file.xlsx');
    }
}
