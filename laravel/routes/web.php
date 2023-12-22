<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\RestricaoController;
use App\Http\Controllers\SubmissoesController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\GestorDocenteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/idp', function () {
    return view('idp');
});

Route::prefix('/docente')->group(function () {
    Route::get('/', [RestricaoController::class, 'docente'])->name('docente');
    Route::get('/restricoes', [RestricaoController::class, 'restricoes'])->name('restricoes');
    Route::post('/restricoes', [RestricaoController::class, 'submeter'])->name('restricoesSubmeter');
});

Route::prefix('/comissao')->group(function () {
    Route::get('/', function () {
        return redirect()->route('submissoes');
    })->name('comissao');

    Route::get('/submissoes', [SubmissoesController::class, 'submissoes'])->name('submissoes');
    Route::post('/submissoes', [SubmissoesController::class, 'submeterData'])->name('submeter.data');

    Route::get('/docentes', [GestorDocenteController::class,'listarDocentes'])->name('gestorDocentes');
    Route::post('/docentes', [GestorDocenteController::class, 'adicionarDocente'])->name('adicionar.docente');
    Route::get('/docente/{id}', [GestorDocenteController::class, 'pesquisarDocente'])->name("docente.show");
    Route::put('/docente/{id}',[GestorDocenteController::class,'editarDocente'])->name("editar.docente");

    Route::get('/ucs', function () {
        return view('gestorUcs');
    })->name('gestorUcs');

    Route::get('/atribuicaoucs', function () {
        return view('atribuicaoUcs');
    })->name('atribuicaoUcs');
});

Route::prefix('/testar')->group(function () {
    Route::get('/models', [TesteController::class, 'testarModels']);

    Route::get('/import', [TesteController::class, 'testarImport']);
    Route::get('/export', [TesteController::class, 'testarExport']);
    Route::get('/export/{docente}', [TesteController::class, 'testarExportDocente']);
});

