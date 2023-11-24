@extends('partials._document')
@section('head')
@include('partials._head', ["titulo" => "Inicio"])
@endsection
@section('header')
@include('partials._header')
@endsection

@section('content')
<div class="container p-0 d-flex flex-column align-items-center mx-auto" style="width: fit-content; margin-top: 200px;">
    <p class="" style="font-size: 20px; font-weight: 600;">Bem-Vindo ao Gestor de Restrições dos Docentes da ESTGA</p>
    <p class="mt-3" style="color: rgb(26, 26, 26)">Faça login como:</p>
    <div class="mt-4">
        <button class="button-style me-4" style="width: 150px; height: 40px; font-size: 20px" id="docente-button">Docente</button>
        <button class="button-style" style="width: 150px; height: 40px; font-size: 20px" id="comissao-button">Comissão</button>
    </div>
</div>
@endsection
