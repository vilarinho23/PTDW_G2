<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\RestricaoController;
use App\Http\Controllers\SubmissoesController;
use App\Http\Controllers\GestorDocenteController;
use App\Http\Controllers\GestorUcController;
use App\Http\Controllers\FakeIdpController;
use App\Http\Controllers\ImportExportController;

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

// Landing page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Fake Idp
Route::prefix('idp')->group(function () {
    Route::get('/', [FakeIdpController::class, 'idp'])->name('idp');
    Route::post('/', [FakeIdpController::class, 'login'])->name('login');
    Route::get('/logout', [FakeIdpController::class, 'logout'])->name('logout');
});

// Docente
Route::prefix('/docente')->middleware('auth_docente')->group(function () {
    Route::get('/', [RestricaoController::class, 'docente'])->name('docente');
    Route::get('/restricoes', [RestricaoController::class, 'restricoes'])->name('restricoes');
    Route::post('/restricoes', [RestricaoController::class, 'submeter'])->name('restricoesSubmeter');
});

// Comissão
Route::prefix('/comissao')->middleware('auth_comissao')->group(function () {
    Route::get('/', function () {
        return redirect()->route('submissoes');
    })->name('comissao');

    Route::prefix('/submissoes')->group(function () {
        Route::get('/', [SubmissoesController::class, 'submissoes'])->name('submissoes');
        Route::post('/', [SubmissoesController::class, 'submeterData'])->name('submeter.data');
        Route::get('/{id}', [SubmissoesController::class, 'restricoes'])->name('submissoes.restricoes');

        Route::get('/export', [ImportExportController::class, 'export'])->name('export.all');
        Route::get('/export/{docente}', [ImportExportController::class, 'exportDocente'])->name('export.docente');
    });

    Route::prefix('/docentes')->group(function () {
        Route::get('/', [GestorDocenteController::class, 'listarDocentes'])->name('gestorDocentes');
        Route::post('/', [GestorDocenteController::class, 'adicionarDocente'])->name('adicionar.docente');
        Route::get('/{id}', [GestorDocenteController::class, 'pesquisarDocente'])->name("docente.show");
        Route::put('/{id}',[GestorDocenteController::class, 'editarDocente'])->name("editar.docente");
        Route::delete('/{id}',[GestorDocenteController::class, 'eliminarDocente'])->name("eliminar.docente");
    });

    Route::prefix('/ucs')->group(function () {
      Route::get('/', [GestorUcController::class, 'getAllUnidadesCurriculares'])->name('gestorUcs');
      Route::post('/', [GestorUcController::class, 'adicionarUnidadeCurricular'])->name('adicionar.unidadeCurricular');
      Route::put('/{id}', [GestorUcController::class, 'updateUnidadeCurricular'])->name('update.unidadeCurricular');
      Route::get('/{id}', [GestorUcController::class, 'pesquisarUnidadeCurricular'])->name("unidadeCurricular.show");
      Route::delete('/{id}',[GestorUcController::class, 'eliminarUnidadeCurricular'])->name("eliminar.unidadeCurricular");
    });

    Route::get('/atribuicaoucs', function () {
        return view('atribuicaoUcs');
    })->name('atribuicaoUcs');
});

// Testes
Route::prefix('/testar')->group(function () {
    Route::get('/models', [TesteController::class, 'testarModels']);

    Route::get('/import', [TesteController::class, 'testarImport']);
});

