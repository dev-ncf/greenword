<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ConsultasController;
use App\Http\Controllers\DoencasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedicosController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DiagnosticoController;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $medicos = Medico::all();
    $pacientes = Paciente::all();
    return view('Home.index',compact(['medicos','pacientes']));

})->name('home');
Route::get('home/sobre', function () {
    return view('Home.about');
})->name('sobre');
Route::get('home/agendar', function () {
    $medicos = Medico::all();
    return view('Home.agendar',compact(['medicos']));
})->name('agendar');
Route::get('home/recursos', function () {
    return view('Home.recursos');
})->name('recursos');
Route::get('home/medicos', function () {
    return view('Home.medicos');
})->name('home-medicos');
Route::get('home/servicos', function () {
    return view('Home.servicos');
})->name('servicos');
Route::get('home/contactar', function () {
    return view('Home.contact');
})->name('contactar');


Auth::routes();



Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('/pacientes', [PacientesController::class, 'index'])->name('pacientes');
Route::get('/pacientes/add', [PacientesController::class, 'create'])->name('add-pacientes');
Route::post('/pacientes/store', [PacientesController::class, 'store'])->name('store-pacientes');
Route::get('/pacientes/show/{paciente}', [PacientesController::class, 'show'])->name('show-pacientes');
Route::get('/pacientes/edit/{paciente}', [PacientesController::class, 'edit'])->name('edit-pacientes');
Route::put('/pacientes/update/{paciente}', [PacientesController::class, 'update'])->name('update-pacientes');
Route::delete('/pacientes/destroy/{paciente}', [PacientesController::class, 'destroy'])->name('destroy-pacientes');

Route::get('/consultas/{data?}', [ConsultasController::class, 'index'])->name('consultas');
Route::get('/consultas/add/{paciente?}',[ConsultasController::class, 'create'])->name('add-consulta');
Route::post('/consultas/store', [ConsultasController::class, 'store'])->name('store-consultas');
Route::get('/consultas/show/{consulta}', [ConsultasController::class, 'show'])->name('show-consulta');
Route::get('/consultas/estado/{consulta}', [ConsultasController::class, 'estado'])->name('estado-consultas');
Route::delete('/consultas/destroy/{consulta}', [ConsultasController::class, 'destroy'])->name('destroy-consultas');


Route::get('/medicos', [MedicosController::class, 'index'])->name('medicos');
Route::get('/medicos/add', [MedicosController::class, 'create'])->name('add-medicos');
Route::post('/medicos/store', [MedicosController::class, 'store'])->name('store-medicos');
Route::get('/medicos/edit/{medico}', [MedicosController::class, 'edit'])->name('edit-medicos');
Route::put('/medicos/update/{medico}', [MedicosController::class, 'update'])->name('update-medicos');
Route::delete('/medicos/destroy/{medico}', [MedicosController::class, 'destroy'])->name('destroy-medicos');

Route::prefix('/doencas')->group(function () {
Route::get('/', [DoencasController::class, 'index'])->name('doencas');
Route::get('/add', [DoencasController::class, 'create'])->name('add-doencas');
Route::get('/show/{doenca}', [DoencasController::class, 'show'])->name('show-doenca');
Route::get('/edit/{doenca}', [DoencasController::class, 'edit'])->name('edit-doenca');
Route::put('/update/{doenca}', [DoencasController::class, 'update'])->name('update-doenca');
Route::post('/store', [DoencasController::class, 'store'])->name('store-doencas');
Route::delete('/destroy/{doenca}', [DoencasController::class, 'destroy'])->name('destroy-doencas');
});

Route::get('/agendas', [AgendaController::class, 'index'])->name('agendas');
Route::get('/agendas/add', [AgendaController::class, 'create'])->name('add-agendas');
Route::post('/agendas/store/{tipo}', [AgendaController::class, 'store'])->name('store-agendas');
Route::get('/agendas/show/{agenda}', [AgendaController::class, 'show'])->name('show-agendas');
Route::delete('/agendas/destroy/{agenda}', [AgendaController::class, 'destroy'])->name('destroy-agendas');


Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios');
Route::get('/usuarios/add', [UserController::class, 'create'])->name('add-usuarios');
Route::post('/usuarios/store', [UserController::class, 'store'])->name('store-usuarios');
Route::get('/usuarios/edit/{user}', [UserController::class, 'edit'])->name('edit-usuarios');
Route::put('/usuarios/update/{user}', [UserController::class, 'update'])->name('update-usuarios');
Route::delete('/usuarios/destroy/{user}', [UserController::class, 'destroy'])->name('delete-usuarios');
Route::get('/usuarios/show/{user}', [UserController::class, 'show'])->name('show-usuarios');


Route::post('/diagnostico', [DiagnosticoController::class, 'store'])->name('diagnostico');
Route::get('/diagnostico/{diagnostico}', [DiagnosticoController::class, 'destroy'])->name('diagnostico-delete');
