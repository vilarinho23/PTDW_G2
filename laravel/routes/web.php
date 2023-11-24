<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\SubmissaoController;

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
});

Route::get('/idp', function () {
    return view('idp');
});


Route::get('/docente', [SubmissaoController::class, 'docente']);

Route::get('/restricoes',function(){
    return view('restricoes');
});


Route::get('/submissoes',function(){
    return view('submissoes');
});

Route::get('/gestorDocentes',function(){
    return view('gestorDocentes');
});

Route::get('/gestoruc',function(){
    return view('gestorUc');
});

Route::get('/atribuicaouc',function(){
    return view('atribuicaoUc');
});


Route::get('/testar/models', [TesteController::class, 'testarModels']);
Route::get('/testar/kv', [TesteController::class, 'testarKV']);
