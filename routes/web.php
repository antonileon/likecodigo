<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ConsultorioController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\EspecialidadeController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Example Routes
//Route::view('/', 'landing');
Route::match(['get', 'post'], '/dashboard', function(){
    return view('dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
});

Auth::routes();
Route::group(['middleware' => ['web', 'auth']], function() {
    ########------------------------DASHBOARD-----------------------------------------------------########
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/home/buscarPacientesAll',[HomeController::class, 'buscarPacientesAll']);
    ########------------------------USUARIOS-----------------------------------------------------########
    Route::controller(UsersController::class)->group(function() {
        Route::get('/users/get-index', 'getIndex');
        Route::post('/users/cambiar-tema', 'cambiarTema');
    });
    ########------------------------EMPRESAS-----------------------------------------------------########
    Route::get('/empresas/get-index',[EmpresaController::class, 'getIndex']);
    ########------------------------CONSULTORIOS-------------------------------------------------########
    Route::get('/consultorios/get-index',[ConsultorioController::class, 'getIndex']);
    Route::post('/consultorios/buscar-empresas',[ConsultorioController::class, 'buscarEmpresas']);
    ########------------------------ROLES---------------------------------------------------------########
    Route::get('/roles/get-index',[RoleController::class, 'getIndex']);
    ########------------------------PERMISOS------------------------------------------------------########
    Route::get('/permissions/get-index',[PermissionController::class, 'getIndex']);
    ########------------------------MEDICOS------------------------------------------------------########
    Route::get('/medicos/get-index',[MedicoController::class, 'getIndex']);
    #########------------------------PACIENTES---------------------------------------------------########
    Route::get('/pacientes/get-index',[PacienteController::class, 'getIndex']);
    #########------------------------PACIENTES---------------------------------------------------########
    Route::get('/excel/pacientes',[ExcelController::class, 'pacientes'])->name('excel.pacientes');
    #########------------------------ESPECIALIDADES----------------------------------------------########
    Route::get('/especialidades/get-index',[EspecialidadeController::class, 'getIndex']);
    ##########------------------------ESPECIALIDADES----------------------------------------------########
    Route::get('/servicios/get-index',[ServicioController::class, 'getIndex']);
    #########------------------------Resources---------------------------------------------------########
    Route::resources([
        'users'          => UsersController::class,
        'empresas'       => EmpresaController::class,
        'consultorios'   => ConsultorioController::class,
        'roles'          => RoleController::class,
        'permissions'    => PermissionController::class,
        'medicos'        => MedicoController::class,
        'pacientes'      => PacienteController::class,
        'servicios'      => ServicioController::class,
        'especialidades' => EspecialidadeController::class,
        'excel'          => ExcelController::class,
    ]);
});

