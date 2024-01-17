<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\RestricaoController;
use App\Http\Controllers\DocenteUcController;
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
        Route::delete('/', [SubmissoesController::class, 'limparSubmissoes'])->name('submissoes.clear');
    });
    Route::get('/export', [ImportExportController::class, 'export'])->name('export.all');
    Route::get('/export/{docente}', [ImportExportController::class, 'exportDocente'])->name('export.docente');

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

    Route::prefix('/atribuicaoucs')->group(function () {
        Route::get('/', [DocenteUcController::class, 'index'])->name('atribuicaoUcs');
        Route::post('/', [DocenteUcController::class, 'store'])->name('atribuicaoUcs.store');
        Route::put('/{num_func}/{cod_uc}', [DocenteUcController::class, 'update'])->name('atribuicaoUcs.update');
        Route::delete('/{num_func}/{cod_uc}', [DocenteUcController::class, 'destroy'])->name('atribuicaoUcs.destroy');
        Route::delete('/', [DocenteUcController::class, 'destroyAll'])->name('atribuicaoUcs.clear');
    });
    Route::post('/import', [ImportExportController::class, 'import'])->name('import');
});

// Testes (apenas em ambiente local)
if (env('APP_ENV', 'local') == 'local')
{
    Route::prefix('/testar')->group(function () {
        Route::get('/models', [TesteController::class, 'testarModels']);
    });
}
