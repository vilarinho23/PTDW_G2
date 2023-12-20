<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\RestricaoController;
use App\Http\Controllers\GestorUcController;
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

    Route::get('/submissoes', function () {
        return view('submissoes');
    })->name('submissoes');

    Route::get('/docentes', function () {
        return view('gestorDocentes');
    })->name('gestorDocentes');

    Route::get('/ucs', [GestorUcController::class, 'getAllUnidadesCurriculares'])->name('gestorUcs');
    Route::post('/uc', [GestorUcController::class, 'adicionarUnidadeCurricular'])->name('adicionarUnidadeCurricular');
    //Route::get('/uc/{id}/edit', [GestorUcController::class, 'editUnidadeCurricular'])->name('editUnidadeCurricular');
    //Route::put('/uc/{id}', [GestorUcController::class, 'updateUnidadeCurricular'])->name('updateUnidadeCurricular');



    Route::get('/atribuicaoucs', function () {
        return view('atribuicaoUcs');
    })->name('atribuicaoUcs');
});

Route::prefix('/testar')->group(function () {
    Route::get('/models', [TesteController::class, 'testarModels']);
});
