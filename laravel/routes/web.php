<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/docente', function(){
    return view('docentePorPreencher');
});

Route::get('/docente2', function(){
    return view('docentePreenchido');
});

Route::get('/restricoes',function(){
    return view('restricoes');
});

Route::get('/gestorDocentes',function(){
    return view('gestorDocentes');
});
Route::get('/docenteSemUC',function(){
    return view('docenteSemUCAtribuidas');
});

Route::get('/atribuicaouc',function(){
    return view('atribuicaouc');
});


Route::get('/submissoes',function(){
    return view('submissoes');
});


Route::get('/docentePreenchido',function(){
    return view('docentePreenchido');
});


Route::get('/gestoruc',function(){
    return view('gestorUc');
});


